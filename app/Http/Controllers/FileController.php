<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App;
use App\File;
use Image;
use Imagick;
use Response;

class FileController extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Fetch files by Type or Id
     * @param  string $type  File type
     * @param  integer $id   File Id
     * @return object        Files list, JSON
     */
    public function index($type, $id = null, Request $request)
    {
        $model = new File();

        if (!is_null($id)) {
            $response = $model::findOrFail($id);
        } else {
            $records_per_page = ($type == 'video') ? 6 : 10;

            $files = $model::where('type', $type)
                            ->where('name', 'like', '%' . $request->get('keywords') . '%')
                            ->where('user_id', Auth::id())
                            ->orderBy('id', 'desc')->paginate($records_per_page);

            $response = [
                'pagination' => [
                    'total' => $files->total(),
                    'per_page' => $files->perPage(),
                    'current_page' => $files->currentPage(),
                    'last_page' => $files->lastPage(),
                    'from' => $files->firstItem(),
                    'to' => $files->lastItem()
                ],
                'data' => $files
            ];
        }

        return response()->json($response);
    }

    /**
     * Upload new file and store it
     * @param  Request $request Request with form data: filename and file info
     * @return boolean          True if success, otherwise - false
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:files',
            'file' => 'required|file|mimes:' . File::getAllExtensions() . '|max:' . File::getMaxSize()
        ]);

        $file = new File();

        $uploaded_file = $request->file('file');
        $original_ext = $uploaded_file->getClientOriginalExtension();
        $type = $file->getType($original_ext);

        if ($file->upload($type, $uploaded_file, $request['name'], $original_ext)) {
            return $file::create([
                    'name' => $request['name'],
                    'type' => $type,
                    'extension' => $original_ext,
                    'user_id' => Auth::id()
                ]);
        }


        return response()->json(false);
    }

    /**
     * Edit specific file
     * @param  integer  $id      File Id
     * @param  Request $request  Request with form data: filename
     * @return boolean           True if success, otherwise - false
     */
    public function edit($id, Request $request)
    {
        $file = File::where('id', $id)->where('user_id', Auth::id())->first();

        if ($file->name == $request['name']) {
            return response()->json(false);
        }

        $this->validate($request, [
            'name' => 'required|unique:files'
        ]);

        $old_filename = $file->getName($file->type, $file->name, $file->extension);
        $new_filename = $file->getName($request['type'], $request['name'], $request['extension']);

        if (Storage::disk('local')->exists($old_filename)) {
            if (Storage::disk('local')->move($old_filename, $new_filename)) {
                $file->name = $request['name'];
                return response()->json($file->save());
            }
        }

        return response()->json(false);
    }

    public function export($id, Request $request)
    {

        /*$file = File::where('id', $id)->where('user_id', Auth::id())->first();

        $originalImage = $file->getName($file->type, $file->name, $file->extension);
        $originalImagePath = Storage::get($originalImage);

        $image = public_path('images/download.' . $file->extension);

        $imageHeight = $request['imageHeight'];
        $imageWidth = $request['imageWidth'];
        $format = $request['format'];
        $colorspace = $request['colorspace'];

        
        if ($img = Image::make($originalImagePath)) {

            $img->resize($imageWidth,$imageHeight);
            $img->encode($format);
            $img->save($image);
            
            //$this->generateCmykImage(public_path('images/download.' . $file->extension));

            $i = new Imagick($image);
            $i->setRegistry('temporary-path', '/efs');
            $i->transformImageColorspace(Imagick::$colorspace);
            $i->writeImage($image);
            $i->clear();

            return response()->download($image, $file->name);//->deleteFileAfterSend(true);
        }

        return response()->json(false);*/
    }

    /**
     * Delete file from disk and database
     * @param  integer $id  File Id
     * @return boolean      True if success, otherwise - false
     */
    public function destroy($id)
    {
        $file = File::findOrFail($id);

        if (Storage::disk('local')->exists($file->getName($file->type, $file->name, $file->extension))) {
            if (Storage::disk('local')->delete($file->getName($file->type, $file->name, $file->extension))) {
                return response()->json($file->delete());
            }
        }

        return response()->json(false);
    }

    public function filter()
    {
        $categories = DB::table('categories')->get();
        return view ('layouts.filter', compact($categories));
    }

}

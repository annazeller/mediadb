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
use App\Category;
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
        $categories = Category::all();
        $model = new File();

        if (!is_null($id)) {
            $response = $model::findOrFail($id);
        } else {
            $records_per_page = ($type == 'video') ? 6 : 10;

            $files = $model::where('type', $type)
                            ->where('name', 'like', '%' . $request->get('keywords') . '%')
                            ->where('category','like', '%' .  $request->get('filter'). '%')
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
                'data' => $files,
                'categories' => $categories
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
        $category = "";
        if ($file->upload($type, $uploaded_file, $request['name'], $original_ext)) {

            if ($original_ext == 'psd') {
                $img = Image::make($uploaded_file);
                $img->encode('jpg');
                $img->save(storage_path('app/public/thumbnails/' . $request['name'] . '_' . Auth::user()->name . '_' . Auth::id() .'.jpg'));
            
            }
            if ($original_ext == 'tif') {        
                $img = Image::make($uploaded_file);
                $img->encode('jpg');
                $img->save(storage_path('app/public/thumbnails/' . $request['name'] . '_' . Auth::user()->name . '_' . Auth::id() .'.jpg'));
            }
            if ($original_ext == 'tiff') {
                $img = Image::make($uploaded_file);
                $img->encode('jpg');
                $img->save(storage_path('app/public/thumbnails/' . $request['name'] . '_' . Auth::user()->name . '_' . Auth::id() .'.jpg'));
            }

            return $file::create([
                    'name' => $request['name'],
                    'type' => $type,
                    'extension' => $original_ext,
                    'user_id' => Auth::id(),
                    'category' => $category,
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
        $file = File::where('id', $id)->where('user_id', Auth::id())->first();

        if ($request['type'] == "file") {

            $imageWidth = $request['imageWidth'];
            $imageHeight = $request['imageHeight'];
            $format = $request['format'];
            $colorspace = $request['colorspace'];

            $this->exportFile($file,$imageWidth,$imageHeight,$format,$colorspace);

        } else if ($request['type'] == "pdf") {

            $imageWidth = $request['pdfImageWidth'];
            $imageHeight = $request['pdfImageHeight'];
            $icc = $request['icc'];

            $this->exportPDF($file,$imageWidth,$imageHeight,$icc);

        } else {
            return response()->json(false);
        }

        return response()->json(false);
    }

    public function exportFile($file,$imageWidth,$imageHeight,$format,$colorspace){
        $originalImage = $file->getName($file->type, $file->name, $file->extension);
        $originalImagePath = Storage::get($originalImage);

        $imagePath = public_path('images/temp/' . $file->name . '.' . $format);
        
        if ($img = Image::make($originalImagePath)) {

            if ($imageWidth && $imageHeight) {
                $img->resize($imageWidth,$imageHeight);
            }
            if ($format) {
                $img->encode($format);
                $imagePath = public_path('images/temp/' . $file->name . '.' . $format);
            } else {
                $imagePath = public_path('images/temp/' . $file->name . '.' . $file->extension);
            }
            $img->save($imagePath);
            

            $i = new Imagick($imagePath);
            
            if ($colorspace) {
                $i = new Imagick($imagePath);

                switch ($colorspace) {
                    case "RGB":
                        $i->transformImageColorspace(Imagick::COLORSPACE_RGB);
                        break;
                    case "SRGB":
                        $i->transformImageColorspace(Imagick::COLORSPACE_SRGB);
                        break;
                    case "CMYK":
                        $i->transformImageColorspace(Imagick::COLORSPACE_CMYK);
                        break;
                    case "GRAY":
                        $i->transformImageColorspace(Imagick::COLORSPACE_GRAY);
                        break;
                    case "YUV":
                        $i->transformImageColorspace(Imagick::COLORSPACE_YUV);
                        break;
                    case "HSL":
                        $i->transformImageColorspace(Imagick::COLORSPACE_HSL);
                        break;
                    case "LAB":
                        $i->transformImageColorspace(Imagick::COLORSPACE_LAB);
                        break;
                }
                
                $i->writeImage($imagePath);
                $i->clear();
            }

            //return response()->json([ 'fileNameAndPath' => '/images/' . $file->name . '.' . $format]);
            //return redirect()->to('/images/' . $file->name . '.' . $format);
            return response()->json(true);

        }
        return response()->json(false);
    }

    public function exportPdf($file,$imageWidth,$imageHeight,$icc){
        $originalImage = $file->getName($file->type, $file->name, $file->extension);
        $originalImagePath = Storage::get($originalImage);

        if ($icc) {
            $iccFile = storage_path('app/icc/' . $icc . '.icc');
        } else {
            $iccFile = storage_path('app/icc/ISOcoated_v2_eci.icc');
        }

        $pdfFilePath = public_path('images/temp/' . $file->name . '.pdf');
        
        if (!$imageWidth or !$imageHeight){
            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'utf-8'
            ]);
        } else {
            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'utf-8', 
                'format' => [$imageWidth, $imageHeight], 
            ]);
        }

        if (($file->extension != "psd") and ($file->extension != "tif") and ($file->extension != "tiff")) {
            $mpdf->imageVars['imagepath'] = $originalImagePath;
        } else {
            $thumbnailPath1 = '/storage/thumbnails/' . $file->name . '_' . Auth::user()->name . '_' . Auth::id() . '.jpg';
            $thumbnailPath = '<img src="' . $thumbnailPath1 . '" width="' . $imageWidth . 'mm" height = "' . $imageHeight . 'mm" />';
            $mpdf->imageVars['imagepath'] = $thumbnailPath;
        }

        $mpdf->imageVars['imageWidth'] = $imageWidth;
        $mpdf->imageVars['imageHeight'] = $imageHeight;
        
        
        $mpdf->img_dpi = 300;
        $mpdf->ICCProfile = $iccFile;
        $mpdf->PDFXauto = true;
        $mpdf->PDFX = true;
        $mpdf->SetTitle($file->name);
        $html = $thumbnailPath;
        $mpdf->WriteHTML($html);
        
        if ($mpdf->Output($pdfFilePath)) {
            return response()->json(true);
        }
    

        return response()->json(false);
    }

    public function download($filename, $fileextension) {
        $imagePath = public_path('images/temp/' . $filename . '.' . $fileextension);
        return response()->download($imagePath)->deleteFileAfterSend(true);
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
}

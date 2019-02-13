<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Iptc;
use Image;
use App\File;
use App\Category;

class MetaController extends Controller
{
    public function index($id)
    {
        $file = File::where('id', $id)->where('user_id', Auth::id())->first();
        $fileextension = $file->extension;
        $user = Auth::user()->name;
        $path = storage_path('app/public/'. $user . '_'. Auth::id(). '/image/'. $file->name .'.'  . $file->extension);
        $filePath = '/storage/'. $user . '_'. Auth::id(). '/image/'. $file->name .'.'  . $file->extension;
        $exifValues = Image::make($path)->exif();
        $documenttitle = Image::make($path)->iptc('DocumentTitle');
        $category = Image::make($path)->iptc('Category');
        $subcategories = Image::make($path)->iptc('Subcategories');
        $keywords = Image::make($path)->iptc('Keywords');
        $autor = Image::make($path)->iptc('AuthorByline');
        $city = Image::make($path)->iptc('City');
        $country = Image::make($path)->iptc('Country');
        $photosource= Image::make($path)->iptc('PhotoSource');
        $copyright = Image::make($path)->iptc('Copyright');
        $caption = Image::make($path)->iptc('Caption');
        $creationdate = Image::make($path)->iptc('CreationDate');
        $creationtime = Image::make($path)->iptc('CreationTime');
        return view('layouts.meta', compact('file','filePath', 'path', 'exifValues', 'fileextension', 'documenttitle', 'category', 'subcategories', 'keywords',
            'autor','city', 'country', 'photosource', 'copyright', 'caption', 'creationdate', 'creationtime' ));
    }

    public function iptc(Request $request){
        $object_name = $request->input('object_name');
        $category = $request->input('category');
        $supplemental_category = $request->input('supplemental_category');
        $keywords = $request->input('keywords');
        $created_date = $request->input('created_date');
        $created_time = $request->input('created_time');
        $creator = $request->input('creator');
        $city= $request->input('city');
        $country= $request->input('country');
        $source = $request->input('source');
        $copyright_string = $request->input('copyright_string');
        $caption = $request->input('caption');

        $imageSource = $request->input('imageSource');
        $imageName = $request->input('imageName');

        $iptc = new Iptc($imageSource);
        if(!empty($object_name)) { $iptc->set(Iptc::OBJECT_NAME, array($object_name));}
        else{$iptc->set(Iptc::OBJECT_NAME, array(null));}
        if(!empty($category)) {
            $iptc->set(Iptc::CATEGORY, array($category));
            $filecategory = File::where('name', $imageName)->where('user_id', Auth::id())->first();
            $filecategory->category = $category;
            $filecategory->save();
            if (Category::where('name', '=',$category)->exists()) {}
            else {
                Category::create([
                    'name' => $category,
                    'user_id' => Auth::id(),
                ]);
            }
        }
        else{$iptc->set(Iptc::CATEGORY, array(null));}
        if(!empty($supplemental_category)) {$iptc->set(Iptc::SUPPLEMENTAL_CATEGORY, array($supplemental_category));}
        else{$iptc->set(Iptc::SUPPLEMENTAL_CATEGORY, array(null));}
        if(!empty($keywords)) { $iptc->set(Iptc::KEYWORDS, array($keywords)); }
        else{$iptc->set(Iptc::KEYWORDS, array(null));}
        if(!empty($created_date)) { $iptc->set(Iptc::CREATED_DATE , array($created_date)); }
        else{$iptc->set(Iptc::CREATED_DATE , array(null));}
        if(!empty($created_time)) { $iptc->set(Iptc::CREATED_TIME, array($created_time)); }
        else{$iptc->set(Iptc::CREATED_TIME, array(null));}
        if(!empty($creator)) { $iptc->set(Iptc::CREATOR , array($creator)); }
        else{$iptc->set(Iptc::CREATOR , array(null));}
        if(!empty($city)) { $iptc->set(Iptc::CITY, array($city)); }
        else{$iptc->set(Iptc::CITY, array(null));}
        if(!empty($country)) { $iptc->set(Iptc::COUNTRY , array($country)); }
        else{$iptc->set(Iptc::COUNTRY , array(null));}
        if(!empty($source)) { $iptc->set(Iptc::SOURCE, array($source)); }
        else{$iptc->set(Iptc::SOURCE, array(null));}
        if(!empty($copyright_string)) { $iptc->set(Iptc::COPYRIGHT_STRING, array($copyright_string)); }
        else{$iptc->set(Iptc::COPYRIGHT_STRING, array(null));}
        if(!empty($caption)) { $iptc->set(Iptc::CAPTION, array($caption)); }
        else{$iptc->set(Iptc::CAPTION, array(null));}
        $iptc->write();
        return redirect()->back();
    }

}
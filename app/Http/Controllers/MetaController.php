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
        $user = Auth::user()->name;
        $path = storage_path('app/public/'. $user . '_'. Auth::id(). '/image/'. $file->name .'.'  . $file->extension);
        $filePath = '/storage/'. $user . '_'. Auth::id(). '/image/'. $file->name .'.'  . $file->extension;
        $exif = Image::make($path)->exif();
        $documenttitle = Image::make($path)->iptc('DocumentTitle');
        $urgency = Image::make($path)->iptc('Urgency');
        $category = Image::make($path)->iptc('Category');
        $subcategories = Image::make($path)->iptc('Subcategories');
        $keywords = Image::make($path)->iptc('Keywords');
        $specialinstructions = Image::make($path)->iptc('SpecialInstructions');
        $autor = Image::make($path)->iptc('AuthorByline');
        $city = Image::make($path)->iptc('City');
        $state = Image::make($path)->iptc('State');
        $country = Image::make($path)->iptc('Country');
        $otr = Image::make($path)->iptc('OTR');
        $photosource= Image::make($path)->iptc('PhotoSource');
        $copyright = Image::make($path)->iptc('Copyright');
        $caption = Image::make($path)->iptc('Caption');
        $creationdate = Image::make($path)->iptc('CreationDate');
        $creationtime = Image::make($path)->iptc('CreationTime');
        return view('layouts.meta', compact('file','filePath', 'path', 'exif', 'documenttitle', 'urgency', 'category', 'subcategories', 'keywords',
            'specialinstructions', 'autor','city', 'state', 'country', 'otr', 'photosource', 'copyright', 'caption', 'creationdate', 'creationtime' ));
    }

    public function iptc(Request $request){
        $object_name = $request->input('object_name');
        $urgency = $request->input('urgency');
        $category = $request->input('category');
        $supplemental_category = $request->input('supplemental_category');
        $keywords = $request->input('keywords');
        $special_instructions = $request->input('special_instructions');
        $created_date = $request->input('created_date');
        $created_time = $request->input('created_time');
        $creator = $request->input('creator');
        $city= $request->input('city');
        $province_state= $request->input('province_state');
        $country= $request->input('country');
        $original_transmission_reference = $request->input('original_transmission_reference');
        $source = $request->input('source');
        $copyright_string = $request->input('copyright_string');
        $caption = $request->input('caption');
        $caption_writer = $request->input('caption_writer');

        $imageSource = $request->input('imageSource');

        $imageName = $request->input('imageName');

        $iptc = new Iptc($imageSource);
        if(!empty($object_name)) { $iptc->set(Iptc::OBJECT_NAME, array($object_name)); }
        if(!empty($urgency)) { $iptc->set(Iptc::PRIORITY , array($urgency)); }
        if(!empty($category)) {
            $iptc->set(Iptc::CATEGORY, array($category));
            $filecategory = File::where('name', $imageName)->where('user_id', Auth::id())->first();
            $filecategory->category = $category;
            $filecategory->save();
            if (Category::where('name', '=',$category)->exists()) {}
            else {
                Category::create([
                    'name' => $category,
                ]);
            }
        }
        if(!empty($supplemental_category)) { $iptc->set(Iptc::SUPPLEMENTAL_CATEGORY, array($supplemental_category)); }
        if(!empty($keywords)) { $iptc->set(Iptc::KEYWORDS, array($keywords)); }
        if(!empty($special_instructions)) { $iptc->set(Iptc::SPECIAL_INSTRUCTIONS , array($special_instructions)); }
        if(!empty($created_date)) { $iptc->set(Iptc::CREATED_DATE , array($created_date)); }
        if(!empty($created_time)) { $iptc->set(Iptc::CREATED_TIME, array($created_time)); }
        if(!empty($creator)) { $iptc->set(Iptc::CREATOR , array($creator)); }
        if(!empty($city)) { $iptc->set(Iptc::CITY, array($city)); }
        if(!empty($province_state)) { $iptc->set(Iptc::PROVINCE_STATE, array($province_state)); }
        if(!empty($country)) { $iptc->set(Iptc::COUNTRY , array($country)); }
        if(!empty($original_transmission_reference)) { $iptc->set(Iptc::ORIGINAL_TRANSMISSION_REFERENCE, array($original_transmission_reference)); }
        if(!empty($source)) { $iptc->set(Iptc::SOURCE, array($source)); }
        if(!empty($copyright_string)) { $iptc->set(Iptc::COPYRIGHT_STRING, array($copyright_string)); }
        if(!empty($caption)) { $iptc->set(Iptc::CAPTION, array($caption)); }
        if(!empty($caption_writer)) { $iptc->set(Iptc::CAPTION_WRITER, array($caption_writer)); }
        $iptc->write();
        return redirect()->back();
    }
}
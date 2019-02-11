<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Iptc;
use Image;

class MetaController extends Controller
{
    public function index()
    {
        return view('layouts.meta');
    }

    public function getimage(Request $request){
        $imageSource = $request['imageSource'];
        $path = storage_path($imageSource);
        $iptc = Image::make($path)->iptc();
        $iptc = serialize($iptc);
        return redirect('/iptc')->with("status", $imageSource)->with("iptc", $iptc);
    }

    public function iptc(Request $request){

        $object_name = $request->input('object_name');
        $edit_status = $request->input('edit_status');
        $priority = $request->input('priority');
        $category = $request->input('category');
        $supplemental_category = $request->input('supplemental_category');
        $fixture_identifer = $request->input('fixture_identifer');
        $keywords = $request->input('keywords');
        $release_date = $request->input('release_date');
        $release_time = $request->input('release_time');
        $special_instructions = $request->input('special_instructions');
        $reference_service = $request->input('reference_service');
        $reference_date = $request->input('reference_date');
        $reference_number = $request->input('reference_number');
        $created_date = $request->input('created_date');
        $created_time = $request->input('created_time');
        $originating_program = $request->input('originating_program');
        $program_version = $request->input('program_version');
        $object_cycle = $request->input('object_cycle');
        $creator = $request->input('creator');
        $city= $request->input('city');
        $province_state= $request->input('province_state');
        $country_code= $request->input('country_code');
        $country= $request->input('country');
        $original_transmission_reference = $request->input('original_transmission_reference');
        $headline = $request->input('headline');
        $credit = $request->input('credit');
        $source = $request->input('source');
        $copyright_string = $request->input('copyright_string');
        $caption = $request->input('caption');
        $local_caption = $request->input('local_caption');
        $caption_writer = $request->input('caption_writer');

        $imageSource = $request->input('imageSource');
        $contents = storage_path($imageSource);

        $iptc = new Iptc($contents);
        if(!empty($object_name)) { $iptc->set(Iptc::OBJECT_NAME, array($object_name)); }
        if(!empty($edit_status)) { $iptc->set(Iptc::EDIT_STATUS, array($edit_status)); }
        if(!empty($priority)) { $iptc->set(Iptc::PRIORITY , array($priority)); }
        if(!empty($category)) { $iptc->set(Iptc::CATEGORY, array($category)); }
        if(!empty($supplemental_category)) { $iptc->set(Iptc::SUPPLEMENTAL_CATEGORY, array($supplemental_category)); }
        if(!empty($fixture_identifer)) { $iptc->set(Iptc::FIXTURE_IDENTIFIER, array($fixture_identifer)); }
        if(!empty($keywords)) { $iptc->set(Iptc::KEYWORDS, array($keywords)); }
        if(!empty($release_date)) { $iptc->set(Iptc::RELEASE_DATE, array($release_date)); }
        if(!empty($release_time)) { $iptc->set(Iptc::RELEASE_TIME, array($release_time)); }
        if(!empty($special_instructions)) { $iptc->set(Iptc::SPECIAL_INSTRUCTIONS , array($special_instructions)); }
        if(!empty($reference_service)) { $iptc->set(Iptc::REFERENCE_SERVICE, array($reference_service)); }
        if(!empty($reference_date)) { $iptc->set(Iptc::REFERENCE_DATE, array($reference_date)); }
        if(!empty($reference_number)) { $iptc->set(Iptc::REFERENCE_NUMBER, array($reference_number)); }
        if(!empty($created_date)) { $iptc->set(Iptc::CREATED_DATE , array($created_date)); }
        if(!empty($created_time)) { $iptc->set(Iptc::CREATED_TIME, array($created_time)); }
        if(!empty($originating_program)) { $iptc->set(Iptc::ORIGINATING_PROGRAM, array($originating_program)); }
        if(!empty($program_version)) { $iptc->set(Iptc::PROGRAM_VERSION, array($program_version)); }
        if(!empty($object_cycle)) { $iptc->set(Iptc::OBJECT_CYCLE , array($object_cycle)); }
        if(!empty($creator)) { $iptc->set(Iptc::CREATOR , array($creator)); }
        if(!empty($city)) { $iptc->set(Iptc::CITY, array($city)); }
        if(!empty($province_state)) { $iptc->set(Iptc::PROVINCE_STATE, array($province_state)); }
        if(!empty($country_code)) { $iptc->set(Iptc::COUNTRY_CODE, array($country_code)); }
        if(!empty($country)) { $iptc->set(Iptc::COUNTRY , array($country)); }
        if(!empty($original_transmission_reference)) { $iptc->set(Iptc::ORIGINAL_TRANSMISSION_REFERENCE, array($original_transmission_reference)); }
        if(!empty($headline)) { $iptc->set(Iptc::HEADLINE, array($headline)); }
        if(!empty($credit)) { $iptc->set(Iptc::CREDIT , array($credit)); }
        if(!empty($source)) { $iptc->set(Iptc::SOURCE, array($source)); }
        if(!empty($copyright_string)) { $iptc->set(Iptc::COPYRIGHT_STRING, array($copyright_string)); }
        if(!empty($caption)) { $iptc->set(Iptc::CAPTION, array($caption)); }
        if(!empty($local_caption)) { $iptc->set(Iptc::LOCAL_CAPTION, array($local_caption)); }
        if(!empty($caption_writer)) { $iptc->set(Iptc::CAPTION_WRITER, array($caption_writer)); }
        $iptc->write();
        return redirect('/');
    }
}
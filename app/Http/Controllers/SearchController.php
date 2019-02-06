<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /*public function index(){
        return view('search.search');
    }*/

    public function search(Request $request)
    {
        $files = File::where('name', $request->keywords)->get();
//        $files = File::all();
        return response()->json($files);
    }
}

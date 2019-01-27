<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->get('search');
        $files = DB::table('files')->where('name', 'like', '%'.$search.'%')->get();
        return view('search.search', ['files' => $files]);
    }
}

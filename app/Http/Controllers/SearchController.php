<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $files = DB::table('files')->where('name', 'like', '%' . $request->get('keywords') . '%')->get();
        return response()->json($files);
    }
}

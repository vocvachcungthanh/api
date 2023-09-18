<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;

class AlbumPublicController extends Controller
{
   public function index(Request $request,$page1){

    $page = $request->input('page', $page1);

    $perPage = $request->input('per_page', $request->limit);
    $album =   Album::orderBy('id', 'desc')->where('status', '=', 1)->paginate($perPage, ['id', 'image','url','title','desc'], 'page', $page);


   return response()->json([
    'code'  => 200,
    'data'  => $album,
   ],200);
   }
}
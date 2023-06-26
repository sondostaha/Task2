<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search($type)
    {
        $post = Post::select('title')->get();
        if($type == $post)
        {
            $posts = Post::where('title','like','%'.$type.'%')->get();
        }else
        {
            $posts = Post::where('content','like','%'.$type.'%')->get();

        }
        return response()->json(['posts'=>$posts]);
    }
}

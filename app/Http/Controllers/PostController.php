<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(Post $Post)
    {
        $Post = $Post->with('category')->get();
        return response()->json($Post);
    }
    public function create(PostRequest $request)
    {
        try{
            $Post = Post::create([
                'title' => $request->title,
                'content' => $request->content,
                // 'category_id' => $request->category_id
            ]);

            return response()->json(['message'=> 'Post added successfully','status' => 200]);
        }
        catch(Exception $ex)
       {
        return response()->json(['message'=> 'smothing goes wrong please try again','status' =>500]);
       }
    }
  
    public function show($id)
    {
        $post = Post::with('category')->find($id);
        if(! $post)
        {
            return response()->json(['message'=> 'this post not found ','status' =>404]);
        }   
        return response()->json(['post'=>$post]);
    }

    public function update(PostRequest $request ,$id)
    {
        try{
            $Post = Post::find($id);
            if(! $Post)
            {
            return response()->json(['message'=> 'this Post not found ']);
            }
            $Post->update([
                'title' => $request->title,
                'content' => $request->content,
                // 'category_id' => $request->category_id
            ]);
            return response()->json(['message'=> 'Post updated successfully','Post' => $Post]);
        }
        catch(Exception $ex)
        {
            return response()->json(['message'=> 'smothing goes wrong please try again','status' =>500]);

        }
    }

    public function delete($id)
    {
        try{
            $Post = Post::find($id);
            if(! $Post)
            {
            return response()->json(['message'=> 'this Post not found ']);
            }
           $Post->delete();
            return response()->json(['message'=> 'Post delete successfully']);
        }
        catch(Exception $ex)
        {
            return response()->json(['message'=> 'smothing goes wrong please try again','status' =>500]);
        }
    }

    public function restorePosts()
    {
        try{
             Post::onlyTrashed()->restore();;
        
            return response()->json(['message'=> 'all Posts restored successfully']);
        }
        catch(Exception $ex)
        {
            return response()->json(['message'=> 'smothing goes wrong please try again','status' =>500]);
        }
    }

    public function restorePost($id)
    {
        try{
             Post::onlyTrashed()->where('id',$id)->restore();;
        
            return response()->json(['message'=> 'post restored successfully' ]);
        }
        catch(Exception $ex)
        {
            return response()->json(['message'=> 'smothing goes wrong please try again','status' =>500]);
        }
    }
}

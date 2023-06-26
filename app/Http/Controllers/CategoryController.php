<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use illuminate\Database\Eloquent\SoftDeletes;
class CategoryController extends Controller
{
    public function index(Category $category)
    {
        $category = $category->with('posts')->get();
        return response()->json($category);
    }
    public function create(CategoryRequest $request)
    {
        try{
            $category = Category::create([
                'name' => $request->name,
            ]);

            return response()->json(['message'=> 'category added successfully','status' => 200]);
        }
        catch(Exception $ex)
       {
        return response()->json(['message'=> 'smothing goes wrong please try again','status' =>500]);
       }
    }

    public function show($id)
    {
        $category = Category::with('posts')->find($id);
        if(! $category)
        {
            return response()->json(['message'=> 'this category not found ']);
        }   
        return response()->json(['category'=>$category]);
    }

    public function update(CategoryRequest $request ,$id)
    {
        try{
            $category = Category::find($id);
            if(! $category)
            {
            return response()->json(['message'=> 'this category not found ','status' =>404]);
            }
            $category->update([
                'name' => $request->name,
            ]);
            return response()->json(['message'=> 'category updated successfully','category' => $category]);
        }
        catch(Exception $ex)
        {
            return response()->json(['message'=> 'smothing goes wrong please try again','status' =>500]);

        }
    }

    public function delete($id)
    {
        try{
            $category = Category::find($id);
            if(! $category)
            {
            return response()->json(['message'=> 'this category not found ','status' =>404]);
            }
           $category->delete();
            return response()->json(['message'=> 'category delete successfully']);
        }
        catch(Exception $ex)
        {
            return response()->json(['message'=> 'smothing goes wrong please try again','status' =>500]);
        }
    }
    public function restoreCategories()
    {
        try{
             Category::onlyTrashed()->restore();;
        
            return response()->json(['message'=> 'all categories restored successfully']);
        }
        catch(Exception $ex)
        {
            return response()->json(['message'=> 'smothing goes wrong please try again','status' =>500]);
        }
    }

    public function restoreCategory($id)
    {
        try{
             Category::onlyTrashed()->where('id',$id)->restore();;
        
            return response()->json(['message'=> 'category restored successfully' ]);
        }
        catch(Exception $ex)
        {
            return response()->json(['message'=> 'smothing goes wrong please try again','status' =>500]);
        }
    }
}

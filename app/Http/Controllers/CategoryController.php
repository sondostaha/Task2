<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Category $category)
    {
        $category = $category->get();
        return response()->json($category);
    }
    public function create(CategoryRequest $request)
    {
        try{
            $category = Category::create([
                'name' => $request->name,
            ]);

            return response()->json(['message'=> 'category added successfully',200]);
        }
        catch(Exception $ex)
       {
        return response()->json(['message'=> 'sothing goes wrong please try again',500]);
       }
    }

    public function update(CategoryRequest $request ,$id)
    {
        try{
            $category = Category::find($id);
            if(! $category)
            {
            return response()->json(['message'=> 'this category not found ']);
            }
            $category->update([
                'name' => $request->name,
            ]);
            return response()->json(['message'=> 'category updated successfully','category' => $category]);
        }
        catch(Exception $ex)
        {
            return response()->json(['message'=> 'sothing goes wrong please try again',500]);

        }
    }

    public function delete($id)
    {
        try{
            $category = Category::find($id);
            if(! $category)
            {
            return response()->json(['message'=> 'this category not found ']);
            }
           $category->delete();
            return response()->json(['message'=> 'category delete successfully']);
        }
        catch(Exception $ex)
        {
            return response()->json(['message'=> 'sothing goes wrong please try again',500]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index()
    {
        $viewBag['categories'] = Category::orderBy('id','desc')->get();
        
        return view('admin.categories.index', $viewBag);
    }

  
    public function create()
    {
        return view('admin.categories.create');
    }

   
    public function store(Request $request)
    {
        $category = new Category; 

        //  dd($category);
                $category->name = $request->name;
                $category->slug = Str::slug($request->name);
        
                $category->save();
                
                return redirect()->route('categories.index');
    }

   
    public function show(Category $category)
    {
        //
    }

  
    public function edit(Category $category)
    {
        //
    }

  
    public function update(Request $request, Category $category)
    {
        //
    }

   
    public function destroy(Category $category)
    {
        $category->delete();
        
        return redirect()->route('admin.categories.index');
    }

    public function toggleStatus(Category $category)
    {
        // return $category;
        $category->is_active = !$category->is_active;
        

        $category->update();
        flash('Category Status Change Successfully ')->success();
        return redirect()->route('categories.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $_getColumns = (['id', 'name',  'user_id', 'is_active']);

    public function index()
    {
        $viewBag['categories']= Category::with('users')->orderBy('id', 'ASC')->get($this->_getColumns);
        
        return view('admin.categories.index', $viewBag);
    }

  
    public function create()
    {
        return view('admin.categories.create');
    }

   
    public function store(Request $request)
    {
        $category = new Category; 

         $category->user_id = auth()->id();
         $category->name = $request->name;
         $category->slug = Str::slug($request->name);
    
         $category->save();
         flash('New Category Create Successfully ')->success();  

        return redirect()->route('categories.index');
    }

   
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

  
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

  
    public function update(Request $request, Category $category)
    {
        // dd($category);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->user_id = auth()->id();

        $category->update();

        flash('Category Update Successfully ')->success();

        return redirect()->route('categories.index');
    }

   
    public function destroy(Category $category)
    {
        $category->delete();

        flash('Category Delete Successfully ')->success();

        return redirect()->route('categories.index');
    }

    public function toggleStatus(Category $category)
    {
      
        $category->is_active = !$category->is_active;
        $category->update();

        flash('Category Status Change Successfully ')->success();

        return redirect()->route('categories.index');
    }
}

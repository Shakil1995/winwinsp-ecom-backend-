<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        //
    }

   
    public function store(Request $request)
    {
        //
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
        //
    }

    public function ChangeStatus(Request $request)
    {
    $category = Category::find($request->category_id);
        $category->is_active = $request->status;
        $category->save();

        return response()->json(['success' => 'Category Active Status Change Successfully.']);
    }
}

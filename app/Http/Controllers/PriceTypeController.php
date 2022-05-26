<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PriceType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PriceTypeController extends Controller
{
    private $_getColumns = (['id', 'name',  'user_id', 'is_active']);
    public function index()
    {
        $viewBag['priceTypes']= PriceType::with('users')->orderBy('id', 'ASC')->get($this->_getColumns);
        
        return view('admin.price-type.index', $viewBag);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.price-type.create');
    }

  
    public function store(Request $request)
    {
        $priceType = new PriceType; 

        $priceType->user_id = auth()->id();
        $priceType->name = $request->name;
        $priceType->slug = Str::slug($request->name);
   
        $priceType->save();
        flash('New Price Type Add Successfully ')->success();  

       return redirect()->route('priceType.index');
    }

   
    public function show(PriceType $priceType)
    {
        $viewBag['pType']= $priceType;
        return view('admin.price-type.show',$viewBag);
    }

 
    public function edit(PriceType $priceType)
    {
        $viewBag['pType']= $priceType;
        return view('admin.price-type.edit',$viewBag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PriceType  $priceType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PriceType $priceType)
    {
 
        $priceType->name = $request->name;
        $priceType->slug = Str::slug($request->name);
        $priceType->user_id = auth()->id();

        $priceType->update();

        flash('PriceType Update Successfully ')->success();

        return redirect()->route('priceType.index');
    }

    
    public function destroy(PriceType $priceType)
    {
        $priceType->delete();

        flash('Price Type Delete Successfully ')->success();

        return redirect()->route('priceType.index');
    }

    public function toggleStatus(PriceType $priceType)
    {
        $priceType->is_active = !$priceType->is_active;
        $priceType->update();

        flash('Price Type  Status Change Successfully ')->success();

        return redirect()->route('priceType.index');
    }
}

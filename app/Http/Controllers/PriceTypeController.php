<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PriceType;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PriceType  $priceType
     * @return \Illuminate\Http\Response
     */
    public function show(PriceType $priceType)
    {
        return view('admin.price-type.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PriceType  $priceType
     * @return \Illuminate\Http\Response
     */
    public function edit(PriceType $priceType)
    {
        return view('admin.price-type.edit');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PriceType  $priceType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PriceType $priceType)
    {
        //
    }
}

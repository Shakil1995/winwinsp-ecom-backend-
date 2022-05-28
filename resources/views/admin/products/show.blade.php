@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('products.index') }}">Product List</a>  </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
        <div class="container">
        	<div class="row">
               <div class="col-xs-4 item-photo">
                @if ($product->image)
                @if (file_exists(public_path('product-images/' . $product->image)))
                    <img src="{{ asset('product-images/' . $product->image) }}"
                        height="400" width="400">
                @else
                    <small>Image not exists in path</small>
                @endif
            @else
                <small>No Image</small>
            @endif
                </div>
                <div class="col-xs-5" style="border:0px solid gray">
                    <!-- Datos del vendedor y titulo del producto -->
                    
                    <div class="row p-1">
                        <div class="col-3 text-end">
                            <strong>Name :</strong>
                        </div>
                        <div class="col-9">
                            <h5>{{ $product->name }}</h5>   
                        </div>
                    </div>
                    <div class="row p-1">
                        <div class="col-3 text-end">
                            <strong>Category :</strong>
                        </div>
                        <div class="col-9">
                            <h3>{{ optional($product->category)->name }}</h3>   
                        </div>
                    </div>
                    <div class="row p-1">
                        <div class="col-3 text-end">
                            <strong>Price :</strong>
                        </div>
                        <div class="col-9">
                            @forelse ($product->productPrices as $row)
                                <div style="border-bottom: 1px solid #ccc; width:350px">
                                    {{ $row->priceType->name ?? 'No Price Type' }} :
                                    <strong>{{ $row->amount ?? 'No Price' }}</strong>  
                                </div>
                            @empty
                                <small>No Price</small>
                            @endforelse
                        </div>
                    </div>
                    <div class="row p-1">
                        <div class="col-3 text-end">
                            <strong>Description :</strong>
                        </div>
                        <div class="col-9">
                          <p>{{ $product->description }}</p>
                        </div>
                    </div>
        
                    <div class="row p-1">
                        <div class="col-3 text-end">
                            <strong>Status :</strong>
                        </div>
                        <div class="col-9">
                         
                            @if ($product->is_active == 1)
                            <button type="submit" class="btn btn-success">Active</button>
                        @else
                            <button type="submit" class="btn btn-danger">Inactive</button>
                        @endif
                        </div>
                    </div>
                                              
                </div>                              
        
            	
            </div>
        </div>        
        @endsection
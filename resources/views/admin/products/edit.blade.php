@extends('layouts.app')


@section('content')



<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">  Product Update </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('products.index') }}">Product List</a>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

             <div class="row">
                <div class="col-12">
                    <form action="{{ route('products.update', $product->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Product Name"
                                    value="{{ $product->name }}" required>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-5">
                                <label for="category_id" class="form-label">Product Category</label>
                                <select class="form-select form-control mb-3" id="category_id" name="category_id">
                                    <option value="" selected>Please Select Product Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if ($category->id == optional($product->category)->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-5">
                                <label for="image" class="form-label">Product Image</label>
                                <input class="form-control" type="file" id="image" name="image">
                            </div>
                            <div class="col-md-2 d-flex align-items-bottom">
                                <img id="preview-image-before-upload"
                                    src="@if ($product->image) {{ asset('product-images/' . $product->image) }} @else {{ asset('assets/images/image-not-available.jpg') }} @endif"
                                    alt="preview image" style="max-height: 95px; max-width:100px">
                            </div>
                        </div>

                        <div class="row g-0 d-flex align-items-end">
                            <div class="col-md-8 col-12 g-0" style="padding-right:5px!important">
                                <label for="price_type_id" class="form-label">Product Price Type</label>
                            </div>

                            <div class="col-md-2 col-12 g-0" style="padding-right:5px!important">
                                <label for="price" class="form-label">Price</label>
                            </div>

                            <div class="col-md-2 col-12 d-flex align-items-end g-0">
                                <a href="javascript:void(0)" class="btn btn-success addMore"><span
                                        class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add More</a>
                            </div>
                        </div>

                        @forelse ($product->productPrices as $row)

                            <div class="row prices g-0 del_row{{ $row->id }}">

                                <input type="hidden" value="{{ $row->id }}" name="product_price_id[]" />

                                <div class="col-md-7 col-12 g-0"
                                    style="margin-top:5px!important; padding-right:5px!important">
                                    <select class="form-select form-control" name="price_type_id[]" id="price_type_id">
                                        <option value="">Select Price Type</option>
                                        @foreach ($price_types as $ptype)
                                            <option value="{{ $ptype->id }}"
                                                @if ($ptype->id == $row->priceType->id) selected @endif>{{ $ptype->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 col-12 g-0"
                                    style="margin-top:5px!important; padding-right:5px!important">
                                    <input type="number" min="0" class="form-control" name="amount[]" id="amount"
                                        placeholder="Price" value="{{ $row->amount }}">
                                </div>
{{-- 
                                <div class="col-md-4 col-12 g-0"
                                    style="margin-top:5px!important; padding-right:5px!important">
                                    <input type="date" class="form-control" name="start_date[]"
                                        value="{{ $row->start_date }}" id="start_date">
                                </div> --}}

                                <div class="col-md-2 col-12 d-flex align-items-end g-0" style="margin-top:5px!important;">
                                    <a href="javascript:void(0)" class="btn btn-danger deleteRecord"
                                        data-id="{{ $row->id }}"><span class="glyphicon glyphicon glyphicon-remove"
                                            aria-hidden="true"></span> Remove</a>
                                </div>

                            </div>

                        @empty

                            <div class="row prices g-0" style="margin-top:5px!important;">

                                <div class="col-sm-12 col-md-3 g-0" style="padding-right:5px!important">
                                    <select class="form-select" name="price_type_new_id[]" id="price_type_id">
                                        <option value="" selected>Select Price Type</option>

                                        @foreach ($price_types as $ptype)
                                            <option value="{{ $ptype->id }}">{{ $ptype->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-md-3 col-12 g-0" style="padding-right:5px!important">
                                    <input type="number" min="0" class="form-control" name="new_amount[]" id="new_amount"
                                        placeholder="Price" value="{{ old('new_amount[]') }}">
                                </div>

                                <div class="col-md-4 col-12 g-0" style="padding-right:5px!important">
                                    <input type="date" class="form-control" name="new_start_date[]"
                                        value="{{ date('Y-m-d') }}" id="new_start_date">
                                </div>

                                <div class="col-md-2 col-12 d-flex align-items-end g-0">
                                    <a href="javascript:void(0)" class="btn btn-danger remove"><span
                                            class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        Remove</a>
                                </div>

                            </div>

                        @endforelse

                        <div class="row">
                            <div class="col-12 mt-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="3">{{ $product->description }}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mt-2">
                                <button type="submit" class="btn btn-primary">Update Product</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <!-- For Add New Input Row -->
            <div class="row pricesCopy" style="display: none;">

                <div class="col-md-7 col-12 g-0" style="padding-right:5px!important">
                    <select class="form-select form-control" name="price_type_new_id[]" id="price_type_id">
                        <option value="" selected>Select Price Type</option>

                        @foreach ($price_types as $ptype)
                            <option value="{{ $ptype->id }}">{{ $ptype->name }}</option>
                        @endforeach

                    </select>
                </div>

                <div class="col-md-3 col-12 g-0" style="padding-right:5px!important">
                    <input type="number" min="0" class="form-control" name="new_amount[]" id="new_amount" placeholder="Price"
                        value="{{ old('new_amount[]') }}">
                </div>

                <div class="col-md-2 col-12 d-flex align-items-end g-0">
                    <a href="javascript:void(0)" class="btn btn-danger remove"><span
                            class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Remove</a>
                </div>

            </div> 

        </div> <!-- Close Card Body-->
    </div>

@endsection


  

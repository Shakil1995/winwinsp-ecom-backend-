@extends('layouts.app')

@section('content')



<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">  Product List </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Product List</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
 <a href="{{ route('products.create') }}"  class="btn btn-success mb-3">Add Product</a>

<table id="datatable" class="display table-sm table-bordered " style="width:100%">
    <thead>
        <tr class="text-center">
            <th>SL NO</th>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Satatus</th>
            <th>Action</th>
            
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach($products as  $key => $product)
        <tr>
            <td>{{ ++$key }}</td>
            <td class="text-center">
                @if ($product->image)
                    @if (file_exists(public_path('product-images/' . $product->image)))
                        <img src="{{ asset('product-images/' . $product->image) }}"
                            height="45" width="60">
                    @else
                        <small>Image not exists in path</small>
                    @endif
                @else
                    <small>No Image</small>
                @endif
            </td>
            <td>{{ $product->name}}</td>
            <td>
              @if (!empty($product->category->name))
                  {{ $product->category->name }}
              @else
                  <span>No Creator Found</span>
              @endif
          </td>

          <td class="text-center">
            @forelse ($product->productPrices as $row)
                <div style="border-bottom: 1px solid #ccc">
                    {{ $row->priceType->name ?? 'No Price Type' }} :
                    {{ $row->amount ?? 'No Price' }}
                    <br>
                    @if ($row->start_date)
                        <small class="text-success"> Start From:
                            {{ date('d F Y', strtotime($row->start_date)) }} <br>
                        </small>
                    @endif
                </div>
            @empty
                <small>No Price</small>
            @endforelse
        </td>

            <td>
              <form action="{{ route('products.toggleStatus',$product->id) }}" method="post">
                @csrf
                @method('GET')

                    @if ($product['is_active'] == 1)
                        <button type="submit" class="btn btn-success">Active</button>
                    @else
                        <button type="submit" class="btn btn-danger">Inactive</button>
                    @endif

                </form>
            </td>
            <td>
                <div class="btn-group" role="group">
                  <a href="{{ route('products.show', $product->id) }}"class="btn btn-primary me-1"> <i class="fa fa-eye"></i></a>
                  <a href="{{ route('products.edit', $product->id) }}"  class="btn btn-success me-1"><i class="fa fa-edit"></i></a>
                  <form action="{{ route('products.destroy', $product->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger"  onclick="return confirm('Delete entry?')"><i class="fa fa-trash"></i></button>
                  </form>
              </div>
            </td>
        </tr>
    @endforeach 
          
    </tbody>
  
</table>



@endsection


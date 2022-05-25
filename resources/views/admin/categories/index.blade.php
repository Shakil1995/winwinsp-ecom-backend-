@extends('layouts.app')

@section('content')



<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">  Categories   List </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Categry List</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
 <a href="{{ route('categories.create') }}"  class="btn btn-success mb-3">Add Category</a>

<table id="datatable" class="display table-sm table-bordered " style="width:100%">
    <thead>
        <tr class="text-center">
            <th>SL NO</th>
            <th>Category Name</th>
            <th>CreatedBy</th>
            <th>Satatus</th>
            <th>Action</th>
            
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach($categories as  $key => $category)
        <tr>
            <td>{{ ++$key }}</td>
      
            <td>{{ $category->name}}</td>
            <td>
              @if (!empty($category->users->name))
                  {{ $category->users->name }}
              @else
                  <span>No Creator Found</span>
              @endif
          </td>
            <td>
              <form action="{{ route('categories.toggleStatus',$category->id) }}" method="post">
                @csrf
                @method('GET')

                    @if ($category['is_active'] == 1)
                        <button type="submit" class="btn btn-success">Active</button>
                    @else
                        <button type="submit" class="btn btn-danger">Inactive</button>
                    @endif

                </form>
            </td>
            <td>
                {{-- <div class="btn-group" role="group">
                    <a href="#"class="btn btn-primary me-1"> <i class="fa fa-eye"></i></a>
                    <a href="#" class="btn btn-info me-1"> <i class="fa fa-edit"></i></a>
                    <form action="{{ route('categories.destroy',$category->id) }}" method="post">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger" onclick="return confirm('Delete entry?')"><i class="fa fa-trash"></i></button>
                    </form>
                </div> --}}
                <div class="btn-group" role="group">
                  <a href="{{ route('categories.show', $category->id) }}"class="btn btn-primary me-1"> <i class="fa fa-eye"></i></a>
                  <a href="{{ route('categories.edit', $category->id) }}"  class="btn btn-success me-1"><i class="fa fa-edit"></i></a>
                  <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger" onclick="return confirm('Delete entry?')"><i class="fa fa-trash"></i></button>
                  </form>
              </div>
            </td>
        </tr>
    @endforeach
          
    </tbody>
  
</table>


@endsection
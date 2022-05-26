@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">  Categories </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('categories.index') }}">Category List</a>  </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Update Category</h3>
          </div>
          <form  method="post" action="{{ route('categories.update',$category->id) }}" >
            @csrf
            <div class="card-body">
              <div class="form-group mt-3">
                <label for="">Category Name</label>
                
            <h4>{{ $category->name }}</h4>
              </div>

          </div>
          </form>
        </div>
      </div>
    </div>
    
@endsection
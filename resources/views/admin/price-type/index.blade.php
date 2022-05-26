@extends('layouts.app')

@section('content')



<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">  Price Type List </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Price Type List</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
 <a href="{{ route('priceType.create') }}"  class="btn btn-success mb-3">Add Price Type</a>

<table id="datatable" class="display table-sm table-bordered " style="width:100%">
    <thead>
        <tr class="text-center">
            <th>SL NO</th>
            <th>Price Type</th>
            <th>CreatedBy</th>
            <th>Satatus</th>
            <th>Action</th>
            
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach($priceTypes as  $key => $ptype)
        <tr>
            <td>{{ ++$key }}</td>
      
            <td>{{ $ptype->name}}</td>
            <td>
              @if (!empty($ptype->users->name))
                  {{ $ptype->users->name }}
              @else
                  <span>No Creator Found</span>
              @endif
          </td>
            <td>
              <form action="{{ route('priceType.toggleStatus',$ptype->id) }}" method="post">
                @csrf
                @method('GET')

                    @if ($ptype['is_active'] == 1)
                        <button type="submit" class="btn btn-success">Active</button>
                    @else
                        <button type="submit" class="btn btn-danger">Inactive</button>
                    @endif

                </form>
            </td>
            <td>
                <div class="btn-group" role="group">
                  <a href="{{ route('priceType.show', $ptype->id) }}"class="btn btn-primary me-1"> <i class="fa fa-eye"></i></a>
                  <a href="{{ route('priceType.edit', $ptype->id) }}"  class="btn btn-success me-1"><i class="fa fa-edit"></i></a>
                  <form action="{{ route('priceType.destroy', $ptype->id) }}" method="post">
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


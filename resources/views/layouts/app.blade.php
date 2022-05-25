<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin.partial.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  {{-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset ('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div> --}}
  @guest
 
   @else
  <!-- Navbar -->
 @include('admin.partial.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->

  @include('admin.partial.sidebar')
  @endguest

  <!-- Content Wrapper. Contains page content -->
  
@yield('content')

   
  <!-- /.content-wrapper -->
 @include('admin.partial.footer')

@include('admin.partial.script')
</div>

</body>
</html>

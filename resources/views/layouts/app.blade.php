<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin.partial.head')
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper" style="height: 100vh">

    @guest
 
   @else
     <!-- Navbar -->
     @include('admin.partial.navbar')
     <!-- /.navbar -->
    
     <!-- Main Sidebar Container -->
     <aside class="main-sidebar sidebar-dark-primary elevation-4 border " > 
    @include('admin.partial.sidebar')
        </aside>
   
        @endguest

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"  id="app">
  <div class="content-header">
    <div class="container-fluid">
      @yield('content')
      </div>
      </div>
    </div>
   

</div>

  <!-- Main Footer -->
@include('admin.partial.footer')
<!-- ./wrapper -->


<!-- REQUIRED SCRIPTS -->
@include('admin.partial.script')

</body>
</html>

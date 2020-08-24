<!DOCTYPE html>
<html lang="en">

@include('adminlte.includes.head')

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    @include('adminlte.includes.navbar')

    <!-- Main Sidebar Container -->
    @include('adminlte.includes.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      @include('adminlte.includes.pageheader')
      @include('adminlte.includes.modal')
      @include('adminlte.includes.error_messages')
      <!-- /.content-header -->

      <!-- Main content -->
      @yield('content')
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



    <!-- Main Footer -->
    @include('adminlte.includes.footer')
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  @include('adminlte.includes.foot')
  @yield('script')
  @yield('menuscript')
  @yield('deletescript')

</body>

</html>
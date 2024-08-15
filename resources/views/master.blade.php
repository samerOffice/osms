<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Favicon -->

  <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/fav.webp')}}" />
  
  <title>
    Otithee ShopNet | @yield('title')
  </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  {{-- <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }} "> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">


  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Theme style -->

  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

  <!--select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- summernote -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <!-- Fahad Employee Module Dashboard CSS -->
  <link href="{{ asset('dist/css/fahad.css') }}" rel="stylesheet">

   <!-- invoice custom css (samer)  -->
  <link href="{{ asset('dist/css/custom-invoice.css') }}" rel="stylesheet">

  <!-- payroll custom css (samer)  -->
  <link href="{{ asset('dist/css/custom-payroll.css') }}" rel="stylesheet">

  <!-- general dashboard css (samer) -->
  <link href="{{ asset('dist/css/general-dashboard.css') }}" rel="stylesheet">

  @stack('css')
</head>

<body class="hold-transition  sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

  <div class="wrapper">
    <!-- Preloader -->
    {{-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> --}}

    <!-- Navbar -->
    @include('partials.header')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    @include('partials.footer')
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <!-- axios -->
  <script src="{{ asset('plugins/axios/axios.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
  <!-- DataTables  & Plugins -->
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }} "></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/adminlte.js') }}"></script>
  <!-- Summernote -->
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <!-- Select2 -->
  <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
  <!-- sweetalert2 --->
  <script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
  @stack('masterScripts')

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
  <script src="{{ asset('plugins/raphael/raphael.min.js') }} "></script>
  <script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
  <script src="{{ asset('plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
  <!-- ChartJS -->
  <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

  <!-- AdminLTE for demo purposes -->
  {{-- <script src="{{ asset('dist/js/demo.js') }}"></script> --}}
 
 <!-- jQuery Knob Chart -->
{{-- <script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script> --}}

<!---- dashboard js  -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
{{-- <script src="{{asset('dist/js/pages/dashboard2.js')}}"></script> --}}
{{-- <script src="{{asset('dist/js/pages/dashboard3.js')}}"></script> --}}

<!-- Fahad Employee Module Dashboard JS -->
<script type="text/javascript" src="{{asset('dist/js/fahad.js')}}"></script>







  
</body>

</html>
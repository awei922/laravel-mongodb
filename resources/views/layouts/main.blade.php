
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel日志管理</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- json-viewer -->
    <link rel="stylesheet" href="{{asset('json-viewer/jquery.json-viewer.css')}}">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('AdminLTE-2.4.3/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('AdminLTE-2.4.3/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('AdminLTE-2.4.3/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{asset('AdminLTE-2.4.3/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('AdminLTE-2.4.3/bower_components/jvectormap/jquery-jvectormap.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('AdminLTE-2.4.3/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('AdminLTE-2.4.3/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('AdminLTE-2.4.3/dist/css/skins/_all-skins.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

@include('layouts/header')
    <!-- Left side column. contains the logo and sidebar -->
@include('layouts/sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    @include('layouts/footer')
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('AdminLTE-2.4.3/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('AdminLTE-2.4.3/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('AdminLTE-2.4.3/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE-2.4.3/dist/js/adminlte.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('AdminLTE-2.4.3/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('AdminLTE-2.4.3/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('AdminLTE-2.4.3/bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.zh-CN.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('AdminLTE-2.4.3/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('AdminLTE-2.4.3/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('AdminLTE-2.4.3/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('AdminLTE-2.4.3/bower_components/chart.js/Chart.js')}}"></script>
<!--json-viewer-->
<script src="{{asset('json-viewer/jquery.json-viewer.js')}}"></script>
<!--common.js-->
<script src="{{asset('js/common.js')}}"></script>

@yield('js_footer')

</body>
</html>
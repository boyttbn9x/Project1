<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Admin</title>
    <base href="{{asset('')}}">
    <!-- Bootstrap Core CSS -->
    <link href="admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="admin/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="admin/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <script type="text/javascript" language="javascript" src="admin/ckeditor/ckeditor.js" ></script>
</head>

<body>
    @if(Auth::check())
        @if(Auth::user()->quyen ==3)
        <div id="wrapper">
            @include('admin.layout_admin.header')
            @include('admin.layout_admin.menu')
            @yield('content')

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="admin/bower_components/jquery/dist/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="admin/dist/js/sb-admin-2.js"></script>

        <!-- DataTables JavaScript -->
        <script src="admin/bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
        <script src="admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

        <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                    responsive: true
            });
        });
        </script>

        @yield('script');
        @else
        Tai khoan cua ban khong co quyen vao trang nay. Vui long quay lai <a href="{{route('trang-chu')}}">Trang chu</a>
        @endif
    @endif
</body>

</html>

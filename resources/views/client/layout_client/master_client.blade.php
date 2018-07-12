<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title>Tour</title>
    <base href="{{asset('')}}">
    
    <link href="dulich/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="dulich/css/tour.css">
    <link href="admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="dulich/js/jquery.js"></script>
    <script src="dulich/js/bootstrap.min.js"></script>
    <script src="dulich/js/tour.js"></script>
</head>
<body style="background-color: #ecf0f1">
	@include('client.layout_client.header_client')
    @include('client.layout_client.modal_client')
    <div class="container">
        @include('client.layout_client.slide_client')
        <div class="space_header"></div>
        <div class="row">@yield('thongbao')</div>
        @include('client.layout_client.menu_client')
        @yield('content')
    </div>
    @include('client.layout_client.footer_client')

</body>
</html>
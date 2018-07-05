<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a class="navbar-brand" style="line-height: 45px">Trang Huong Dan Vien</a>
    </div>
    <!-- /.navbar-header -->
    @if(Auth::user())
    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                @if(Auth::user()->anhdaidien == "")
                    <i class="fa fa-user fa-fw"></i> 
                @else 
                    <img src="upload/{{Auth::user()->anhdaidien}}" width="50" height="45">
                @endif {{Auth::user()->hoten}} <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="{{route('dang-xuat')}}"><i class="fa fa-sign-out fa-fw"></i> Dang xuat</a></li>
                <li><a href="{{route('trang-chu')}}"><i class="glyphicon glyphicon-arrow-left"></i> Trang chu</a></li>     
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->
    @endif
    @if(Auth::user()->status != 2)
        <marquee><font size="30" color="red">Ban can lien he admin qua so dien thoai 01683494193 de duoc cap quyen tao tour</font></marquee>
    @endif
    <!-- /.navbar-static-side -->
</nav>


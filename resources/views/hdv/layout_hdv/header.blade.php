<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a class="navbar-brand" style="line-height: 45px">Trang Huong Dan Vien</a>
    </div>
    @if(Auth::user())
    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                @if(Auth::user()->anhdaidien == "")
                    <i class="fa fa-user fa-fw"></i> 
                @else 
                    <img src="upload/{{Auth::user()->anhdaidien}}" width="50" height="45">
                @endif {{Auth::user()->hoten}} <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="{{route('trang-chu')}}"><i class="glyphicon glyphicon-home"></i> Trang chu</a></li>
                <li><a href="{{route('dang-xuat')}}"><i class="fa fa-sign-out fa-fw"></i> Dang xuat</a></li>       
            </ul>
        </li>
    </ul>
    @endif
    @if(Auth::user()->trangthaihdv != 2)
        <script type="text/javascript">
            setInterval(function(){
                alert("Ban can lien he admin qua so dien thoai 0168xxxxxxx de duoc cap quyen tao tour")
            }, 3000);
        </script>
    @endif
</nav>


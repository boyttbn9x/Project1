<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        @if(Auth::user()->status == 2)
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form"></div>
            </li>
            <li>
                <a href=""><i class="fa fa-bar-chart-o fa-fw"></i> Quan ly Tour <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="hdv/tour">Danh sách Tour cua toi</a></li>
                    <li><a href="hdv/tour/create">Them Tour</a></li>
                </ul>
            </li>
            <li>
                <a href=""><i class="fa fa-bar-chart-o fa-fw"></i>Quan ly don dat tour <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{route('dsdontour')}}">Danh sach don dat tour</a></li>
                    <li><a href="{{route('dsdontourmoi')}}">Don dat tour moi</a></li>
                    <li><a href="{{route('dsdontourthanhtoan')}}">Don dat tour đã thanh toán</a></li>
                </ul>
            </li>
        </ul>
        @endif
    </div>
</div>
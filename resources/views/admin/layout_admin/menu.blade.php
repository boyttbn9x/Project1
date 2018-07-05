<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href=""><i class="fa fa-bar-chart-o fa-fw"></i> Quan ly nguoi dung<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('dskhach1')}}">Danh sách Khach hang</a>
                    </li>
                    <li>
                        <a href="{{route('dshdv1')}}">Danh sách Huong dan vien</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href=""><i class="fa fa-bar-chart-o fa-fw"></i>Thong ke<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('thongke-doanhthu')}}">Thong ke doanh thu</a>
                    </li>
                    <li>
                        <a href="{{route('thongke-donhang')}}">Thong ke don hang</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href=""><i class="fa fa-bar-chart-o fa-fw"></i>Quan ly binh luan<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('dsbinhluan')}}">Danh sach binh luan</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href=""><i class="fa fa-bar-chart-o fa-fw"></i>Quan ly Dia diem du lich<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('diadiem.index')}}">Danh sach dia diem du lich</a>
                    </li>
                    <li>
                        <a href="{{route('diadiem.create')}}">Them dia diem du lich</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
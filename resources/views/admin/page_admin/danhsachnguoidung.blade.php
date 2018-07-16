@extends('admin.layout_admin.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">   	
        <div class="row">
        	@if(isset($dskhach))
            <div class="col-lg-12">
                <h1 class="page-header">Danh sach
                    <small>Khach hang</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
                @if(session('thongbao'))
                <div class="alert alert-success" style="margin-top: 100px; width: 40%" align="center">
                    {{session('thongbao')}}
                </div>
                @endif
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>Ho ten</th>
                        <th>Email</th>
                        <th>Gioi tinh</th>
                        <th>So dien thoai</th>
                        <th>Dia chi</th>
                        <th>Xoa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dskhach as $dsk)
                        <tr class="odd gradeX" align="center">
                            <td>{{$dsk->hoten}}</td>
                            <td>{{$dsk->email}}</td>
                            @if($dsk->gioitinh == 1)
                                <td>Nam</td>
                            @elseif($dsk->gioitinh === 0)
                                <td>Nu</td>
                            @else
                                <td>NULL</td>
                            @endif
                            <td>{{$dsk->sodienthoai}}</td>
                            <td>{{$dsk->diachi}}</td>                   
                            <td class="center">
                                <form action="{{route('xoa-user',$dsk->id)}}" method="post">
                                    @method('delete')
                                    {{csrf_field()}}
                                    <button type="submit" onclick="return xoa();"><i class="fa fa-trash-o  fa-fw"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @elseif(isset($dshdv))
            <div class="col-lg-12">
                <h1 class="page-header">Danh sach
                    <small>Huong dan vien</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            @if(session('thongbao'))
            <div class="alert alert-success" style="margin-top: 100px; width: 40%" align="center">
                {{session('thongbao')}}
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success" style="margin-top: 100px; width: 40%" align="center">
                {{session('success')}}
            </div>
            @endif
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>Ho ten</th>
                        <th>Email</th>
                        <th>So dien thoai</th>
                        <th>Dia chi</th>
                        <th>Xoa</th>
                        <th>Quyen tao tour</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dshdv as $dsh)
                        <tr class="odd gradeX" align="center">
                            <td>{{$dsh->hoten}}</td>
                            <td>{{$dsh->email}}</td>
                            <td>{{$dsh->sodienthoai}}</td>
                            <td>{{$dsh->diachi}}</td>              
                            <td class="center">
                                <form action="{{route('xoa-user',$dsh->id)}}" method="post">
                                    @method('delete')
                                    {{csrf_field()}}
                                    <button type="submit" onclick="return xoaHdv()"><i class="fa fa-trash-o  fa-fw"></i></button>
                                </form>
                            </td>
                            @if($dsh->trangthaihdv == "" || $dsh->trangthaihdv == 1)
                                <td class="center"><a href="{{route('cnhdv1',$dsh->id)}}" onclick="return chapnhan()"> Chap nhan</a></td>
                            @else
                                <td class="center">Da co quyen</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        	@endif
        </div>    
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        function xoa(){
            return confirm('Ban co chac xoa khach hang nay?')
        }
        function xoaHdv(){
            return confirm('Ban chac chan xoa HDV nay chu?')
        }
        function chapnhan(){
            return confirm('Ban chac chan cap quyen cho HDV nay chu?')
        }
    </script>
@endsection
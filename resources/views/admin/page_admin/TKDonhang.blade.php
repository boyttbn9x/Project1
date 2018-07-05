@extends('admin.layout_admin.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Danh sach
                    <small>Don hang</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>Ten tour</th>
                        <th>Email khach</th>
                        <th>Tong tien</th>
                        <th>Thoi gian bat dau</th>
                        <th>Ngay dat tour</th>
                        <th>Tinh trang don</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bill as $dsb)
                        <tr class="odd gradeX" align="center">
                            <td><a href="{{route('chitiet',$dsb->tour_id)}}">{{$dsb->tentour}}</a></td>
                            <td>{{$dsb->email}}</td>
                            <td>{{number_format($dsb->tongtien)}}</td>
                            <td>{{$dsb->timeBD}}</td>
                            <td><?php echo date('Y-m-d', strtotime($dsb->created_at)) ?></td>
                            @if($dsb->tinhtrangdon == 0) 
                            <td style="color: blue">Don moi</td> 
                            @elseif($dsb->tinhtrangdon == 1) 
                            <td>Duoc chap nhan</td>
                            @elseif($dsb->tinhtrangdon == 2) 
                            <td style="color: red"><i class = "glyphicon glyphicon-remove"></i> Bi tu choi</td>
                            @elseif($dsb->tinhtrangdon == 3) 
                            <td style="color: green"><i class="glyphicon glyphicon-ok"></i> Da thanh toan</td>  
                            @endif  
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
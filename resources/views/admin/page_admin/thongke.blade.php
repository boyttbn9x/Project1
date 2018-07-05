@extends('admin.layout_admin.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            @if(isset($bill))
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
                            <td><a href="{{route('chi-tiet',$dsb->tour_id)}}">{{$dsb->tour->tentour}}</a></td>
                            <td>{{$dsb->users->email}}</td>
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
            @elseif(isset($doanhthu))
            <div class="col-lg-12">
                <h1 class="page-header">Danh sach
                    <small>Doanh thu</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>HDV</th>
                        <th>ID don hang</th>
                        <th>Tong tien</th>
                        <th>So tien HDV nhan duoc</th>
                        <th>Trang thai nhan tien</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sum = 0 ?>
                    @foreach($doanhthu as $dt)
                        <tr class="odd gradeX" align="center">
                            <td>{{$dt->email}}</td>
                            <td>{{$dt->id}}</td>
                            <td>{{$dt->tongtien}}</td>
                            <td>{{$dt->tongtien * 9/10}}</td>
                            <?php $sum += $dt->tongtien ?> 
                            <td></td>                             
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="font-size: 20px">Tong so tien cua tat ca don hang: <b style="color: red"><?php echo $sum.' VND' ?></b></div>
            @endif
        </div>
    </div>
</div>
@endsection
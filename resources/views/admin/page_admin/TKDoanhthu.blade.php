@extends('admin.layout_admin.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Danh sach
                    <small>Doanh thu</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            @if(session('success'))
                <div class="alert alert-success" style="margin-top: 100px; width: 40%" align="center">
                    {{Session::get('success')}}
                </div>
            @endif

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
                    @foreach($bill as $bll)
                        <tr class="odd gradeX" align="center">
                            <td>{{$bll->email}}</td>
                            <td>{{$bll->id}}</td>
                            <td>{{$bll->tongtien}}</td>
                            <td>{{$bll->tongtien * 9/10}}</td>
                            <?php $sum += $bll->tongtien ?> 
                            <td></td>                             
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="font-size: 20px">Tong so tien cua tat ca don hang: <b style="color: red"><?php echo $sum.' VND' ?></b></div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        function tratien() {
            return confirm('Ban chac chan da tra tien roi chu?')
        }
    </script>
@endsection
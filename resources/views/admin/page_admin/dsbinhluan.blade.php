@extends('admin.layout_admin.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">      
            <div class="col-lg-12">

                <h1 class="page-header">Danh sach
                    <small>Binh luan</small>
                </h1>
            </div>

            @if(session('thongbao'))
                <div class="alert alert-success" style="margin-top: 100px; width: 40%" align="center">
                    {{session('thongbao')}}
                </div>
            @endif
            <!-- /.col-lg-12 -->     
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
               
                <thead>
                    <tr align="center">
                        <th>Ten tour</th>
                        <th>Email binh luan</th>
                        <th>Noi dung binh luan</th>
                        <th>Xoa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comment as $bl)
                        <tr class="odd gradeX" align="center">
                            <td><a href="{{route('chitiet',$bl->tour_id)}}">{{$bl->tentour}}</a></td>
                            <td>{{$bl->email}}</td>
                            <td>{{$bl->noidung}}</td>
                            <td><i class="fa fa-trash-o  fa-fw"></i><a onclick="return xoa()" href="{{route('xoabinhluan', $bl->id)}}"> Delete</a></td>
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

@section('script')
    <script type="text/javascript">
        function xoa(){
            return confirm('Ban chac chan xoa binh luan nay chu?')
        }
    </script>
@endsection
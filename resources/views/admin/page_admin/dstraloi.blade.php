@extends('admin.layout_admin.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">      
            <div class="col-lg-12">
                <h1 class="page-header">Danh sach
                    <small>Tra loi binh luan</small>
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
                        <th>ID</th>
                        <th>ID binh luan</th>
                        <th>ID nguoi dung</th>
                        <th>Noi dung tra loi</th>
                        <th>Xoa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($traloi as $tl)
                        <tr class="odd gradeX" align="center">
                            <td>{{$tl->id}}</td>
                            <td>{{$tl->comment_id}}</td>
                            <td>{{$tl->users_id}}</td>
                            <td>{{$tl->ndtraloi}}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick = "return xoa()"
                                href="{{route('xoatraloi', $tl->id)}}"> Delete</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        function xoa(){
            return confirm('Ban chac chan xoa binh luan nay chu?')
        }
    </script>
@endsection
@extends('admin.layout_admin.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">      
            <div class="col-lg-12">
                <h1 class="page-header">Danh sach
                    <small>Dia diem du lich</small>
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
                        <th>Ten dia diem du lich</th>
                        <th>Sua</th>
                        <th>Xoa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dsdd as $ds)
                        <tr class="odd gradeX" align="center">
                            <td>{{$ds->id}}</td>
                            <td>{{$ds->tendiadiem}}</td>
                            <td><a href="{{route('diadiem.edit',$ds->id)}}"><button><i class="glyphicon glyphicon-pencil"></i></button></a></td>
                            <td>
                                <form action="{{route('diadiem.destroy',$ds->id)}}" method="post">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    @method('delete')
                                    <button type="submit" onclick="return xoa()"><i class="fa fa-trash-o fa-fw"></i></button>
                                </form>
                            </td>
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
            return confirm('Ban chac chan xoa dia diem nay chu?')
        }
    </script>
@endsection
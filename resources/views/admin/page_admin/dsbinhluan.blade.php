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
            <table class="table table-striped table-bordered table-hover">
               
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
                        @if($bl->parent_id == 0)
                            <tr class="odd gradeX" align="center">
                                <td><a href="{{route('chi-tiet',$bl->tour_id)}}">{{$bl->tour->tentour}}</a></td>
                                <td>{{$bl->users->email}}</td>
                                <td>{{$bl->noidung}}</td>
                                <td><i class="fa fa-trash-o  fa-fw"></i><a onclick="return xoa()" href="{{route('xoabinhluan', $bl->id)}}"> Delete</a></td>
                            </tr>
                            @foreach($comment as $tl)
                                @if($tl->parent_id == $bl->id)
                                <tr class="odd gradeX" align="center">
                                    <td></td>
                                    <td>{{$tl->users->email}}</td>
                                    <td>{{$tl->noidung}}</td>
                                    <td><i class="fa fa-trash-o  fa-fw"></i><a onclick="return xoa()" href="{{route('xoabinhluan', $tl->id)}}"> Delete</a></td>
                                </tr>
                                @endif
                            @endforeach
                        @endif          
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
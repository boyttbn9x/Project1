@extends('layout_hdv.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row" style="width: 60%; margin: 20px" >

            @if(session('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
            @endif
            @if(session('loi'))
                <div class="alert alert-danger">
                    {{Session::get('loi')}}
                </div>
            @endif

            <div class="btn btn-success" style="width: 100%">
                <h2 style="margin-top:0px; margin-bottom:0px; text-align: center;"> Them anh khac cho Tour</h2>
            </div>
            <div class="panel-body">
                <form action="{{route('them-anh-tour',$tour->id)}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"> 

                    <label>Ten tour</label>
                    <input type="text" class="form-control" name="tentour" value="{{$tour->tentour}}" readonly="">
                    <br>
                    
                    <label>Hinh anh khac</label>
                    <input type="file" class="form-control" name="image">
                    <br>

                    @if($tour->imagetour->count() >= 5)
                        <div class="alert alert-danger text-center">Toi da chi them duoc 5 anh</div>
                    @else
                        <div align="center"><button type="submit" class="btn btn-success">Them</button></div>
                    @endif
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
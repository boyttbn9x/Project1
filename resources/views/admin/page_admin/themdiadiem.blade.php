@extends('admin.layout_admin.index')
@section('content')
<div id="page-wrapper">
    <div class="col-md-2 col-xs-2 col-ms-2"></div>
    <div class="col-md-8 col-xs-8 col-ms-8">
        <div class="panel panel-default" style="width: 80%; margin-top: 20px" >

            @if(!isset($dd))
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                        {{$err}}<br>
                    @endforeach
                </div>
            @endif
            @if(session('thanhcong'))
                <div class="alert alert-success">
                    {{Session::get('thanhcong')}}
                </div>
            @endif
            <div class="btn btn-success" style="width: 100%">
                <h2 style="margin-top:0px; margin-bottom:0px; text-align: center;"> Them Dia Diem</h2>
            </div>
            <div class="panel-body">
                <form action="{{route('diadiem.store')}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"> 

                    <label>Dia diem</label>
                    <input type="text" class="form-control" name="tendiadiem">
                    <br>

                    <div align="center">
                        <button type="submit" class="btn btn-success">Them</button>
                    </div>
                </form>
            </div>
            @else
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                        {{$err}}<br>
                    @endforeach
                </div>
            @endif
            @if(session('ok'))
                <div class="alert alert-success">
                    {{Session::get('ok')}}
                </div>
            @endif
            <div class="btn btn-success" style="width: 100%">
                <h2 style="margin-top:0px; margin-bottom:0px; text-align: center;"> Sua Dia Diem</h2>
            </div>          
            <div class="panel-body">
                <form action="{{route('diadiem.update',$dd->id)}}" method="post">
                    @method('put')
                    <input type="hidden" name="_token" value="{{csrf_token()}}"> 

                    <label>Dia diem</label>
                    <input type="text" class="form-control" name="tendiadiem" value="{{$dd->tendiadiem}}">
                    <br>

                    <div align="center">
                    <button type="submit" class="btn btn-success">Sua</button>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
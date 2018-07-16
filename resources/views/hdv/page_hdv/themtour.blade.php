@extends('hdv.layout_hdv.index')
@section('content')
<div>
    <div class="col-md-8 col-sm-8 col-xs-8 col-sm-offset-3">
        <div class="panel panel-default" style="margin-top: 20px" >
            @if(session('thanhcong'))
                <div class="alert alert-success">
                    {{Session::get('thanhcong')}}
                </div>
            @endif
            @if(session('loi'))
                <div class="alert alert-danger">
                    {{Session::get('loi')}}
                </div>
            @endif
            @if(session('loiSokhachmax'))
                <div class="alert alert-danger">
                    {{Session::get('loiSokhachmax')}}
                </div>
            @endif
            @if(session('loiGiatour'))
                <div class="alert alert-danger">
                    {{Session::get('loiGiatour')}}
                </div>
            @endif

            @if(!isset($idt))
            <div class="btn btn-success" style="width: 100%">
                <h2 style="margin-top:0px; margin-bottom:0px; text-align: center;"> Them Tour</h2>
            </div>
            <div class="panel-body">
                <form action="hdv/tour" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"> 

                    <label>Ten tour</label>
                    <span style="color: red; margin-left: 20px">{{$errors->first('tentour')}}</span>
                    <input type="text" class="form-control" name="tentour"value="{{old('tentour')}}">
                    <br>

                    <label>Dia diem</label>
                    <select name="diadiem" class="form-control">
                        @foreach($dd as $dc)
                        <option value="{{$dc->id}}">{{$dc->tendiadiem}}</option>
                        @endforeach
                    </select>
                    <br>

                    <label>So khach max</label>
                    <span style="color: red; margin-left: 20px">{{$errors->first('sokhachtoida')}}</span>
                    <input type="text" class="form-control" name="sokhachtoida" value="{{old('sokhachtoida')}}">
                    <br>

                    <label>So ngay di</label>
                    <span style="color: red; margin-left: 20px">{{$errors->first('songaydi')}}</span>
                    <input type="text" class="form-control" name="songaydi" value="{{old('songaydi')}}">
                    <br>

                    <label>Gia tour</label>
                    <span style="color: red; margin-left: 20px">{{$errors->first('giatour')}}</span>
                    <input type="text" class="form-control" name="giatour" value="{{old('giatour')}}">
                    <br>

                    <label>Mo ta</label>
                    <span style="color: red; margin-left: 20px">{{$errors->first('mota')}}</span>
                    <textarea class="form-control" name="mota" rows="8" class="ckeditor" id="mota">{{old('mota')}}</textarea>
                    <br>

                    <label>Hinh anh</label>
                    <input type="file" class="form-control" name="hinhanh">
                    <br>

                    <div align="center">
                    <button type="submit" class="btn btn-success">Them</button>
                    </div>
                </form>
            </div>
            @else
            <div class="btn btn-success" style="width: 100%">
                <h2 style="margin-top:0px; margin-bottom:0px; text-align: center;"> Sua Tour</h2>
            </div>
            <div class="panel-body">
                <form action="{{route('tour.update', $idt->id)}}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    <input type="hidden" name="_token" value="{{csrf_token()}}"> 

                    <label>Ten tour</label>
                    <span style="color: red; margin-left: 20px">{{$errors->first('tentour')}}</span>
                    <input type="text" class="form-control" name="tentour"value="{{$idt->tentour}}">
                    <br>

                    <label>Dia diem</label>
                    <select name="diadiem" class="form-control">
                        @foreach($dd as $dc)
                        <option value="{{$dc->id}}" @if($idt->diadiem_id == $dc->id) selected="" @endif >{{$dc->tendiadiem}}</option>
                        @endforeach
                    </select>
                    <br>

                    <label>So khach toi da</label>
                    <span style="color: red; margin-left: 20px">{{$errors->first('sokhachtoida')}}</span>
                    <input type="text" class="form-control" name="sokhachtoida" value="{{$idt->sokhachtoida}}">
                    <br>

                    <label>So ngay di</label>
                    <span style="color: red; margin-left: 20px">{{$errors->first('songaydi')}}</span>
                    <input type="text" class="form-control" name="songaydi" value="{{$idt->songaydi}}">
                    <br>

                    <label>Gia tour</label>
                    <span style="color: red; margin-left: 20px">{{$errors->first('giatour')}}</span>
                    <input type="text" class="form-control" name="giatour" value="{{$idt->giatour}}">
                    <br>

                    <label>Mo ta</label>
                    <span style="color: red; margin-left: 20px">{{$errors->first('mota')}}</span>
                    <textarea class="form-control" name="mota" rows="8">{{$idt->mota}}</textarea>
                    <br>

                    <label>Hinh anh</label>
                    <input type="file" class="form-control" name="hinhanh">
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
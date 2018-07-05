@extends('master_client')
@section('content')

<div class="col-md-9 col-xs-9 col-sm-9">
	<div class="panel panel-default">
        @if(isset($user))
		<div class="panel-heading" style="background-color:#337AB7; color:white;" >
			<h2 style="margin-top:0px; margin-bottom:0px; text-align: center;"> Thong tin Ca nhan</h2>
		</div>

		<div class="panel-body">
			<div class="row-item row">
				<div class="col-md-12 border-right">
					<div class="col-md-9 col-sm-9 col-xs-9">
						<h3>Ho ten: <a>{{$user->hoten}}</a></h3>

						<p>Email: {{$user->email}}<p>
						@if($user->namsinh != "")
						<p>Nam sinh: {{$user->namsinh}}</p>
						@endif

						@if($user->gioitinh != "")
						<p>Gioi tinh: {{$user->gioitinh}}</p>
						@endif

						@if($user->anhdaidien != "")
						<p>Anh dai dien:<br> <img src="upload/{{$user->anhdaidien}}" width="200" height="200"></p>
						@endif

						<p>Dia chi: {{$user->diachi}}</p>
						<p>So dien thoai: {{$user->sodienthoai}}</p>
						<a class="btn btn-primary" href="" data-toggle="modal" data-target="#SuaThongTin">Sua thong tin <span class="glyphicon glyphicon-chevron-right"></span></a>
					</div>
				</div>
			</div>

			<div class="modal" id="SuaThongTin">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <button type="button" class="btn btn-danger" data-dismiss="modal" style="float: right; padding: 3px 20px; font-weight: bold;">X</button>
			            <!-- Modal Header -->
			            <div class="modal-header" style="background-color: #66FFFF">  
			                <div align="center" style="font-size: 32px; font-weight: bold; color: red">Sua thong tin</div>
			            </div>

			            <!-- Modal body -->
			            <div class="modal-body">
			            	@if(Session::has('suathanhcong'))
					            <div class="alert alert-success text-center">{{Session::get('suathanhcong')}}</div>
					        @endif
			                <form action="{{route('sua-thong-tin')}}" method="post" enctype="multipart/form-data">
				                <input type="hidden" name="_token" value="{{csrf_token()}}">

				                <label>Họ tên</label>
				                <span style="color: red; margin-left: 20px">{{$errors->first('hoten')}}</span>
				                <input type="text" class="form-control" name="hoten" value="{{$user->hoten}}">
				                <br>

				                <input type="checkbox" name="checkpassword" id="changePassword"><label> Thay doi mat khau</label><br>

				                <label>Mật khẩu moi</label>
				                <span style="color: red; margin-left: 20px">{{$errors->first('password')}}</span>
				                <input type="password" class="form-control password" name="password" disabled="">
				                <br>

				                <label>Xac nhan mat khẩu moi</label>
				                <span style="color: red; margin-left: 20px">{{$errors->first('passwordAgain')}}</span>
				                <input type="password" class="form-control password" name="passwordAgain" disabled="">
				                <br>

				                <label>Anh dai dien</label>
				                @if(Session::has('loianh')) 
				                	<span style="color: red; margin-left: 20px">{{Session::get('loianh')}}</span>
				                @endif
				                <input type="file" class="form-control" name="anhdaidien" value="{{$user->anhdaidien}}">
				                <br>

				                <label>So dien thoai</label>
				                <span style="color: red; margin-left: 20px">{{$errors->first('sodienthoai')}}</span>
				                <input type="text" class="form-control" name="sodienthoai" value="{{$user->sodienthoai}}">
				                <br>

				                <label>Dia chi</label>
				                <input type="text" class="form-control" name="diachi" value="{{$user->diachi}}">
				                <br>

				                <label>Nam sinh</label>
				                @if(Session::has('loinamsinh')) 
				                	<span style="color: red; margin-left: 20px">{{Session::get('loinamsinh')}}</span>
				                @endif
				                <input type="text" class="form-control" name="namsinh" value="{{$user->namsinh}}">
				                <br>

				                <label>Gioi tinh:</label>                                
				                @if($user->gioitinh == 'Nam')
								<input type="radio" name="gioitinh" value="Nam" style="margin-left: 80px" checked=""> Nam
								<input type="radio" name="gioitinh" value="Nu" style="margin-left: 80px"> Nu
								@elseif($user->gioitinh == 'Nu')
								<input type="radio" name="gioitinh" value="Nam" style="margin-left: 80px"> Nam
								<input type="radio" name="gioitinh" value="Nu" style="margin-left: 80px" checked=""> Nu
								@else
								<input type="radio" name="gioitinh" value="Nam" style="margin-left: 80px"> Nam
								<input type="radio" name="gioitinh" value="Nu" style="margin-left: 80px"> Nu
								@endif
				                <br>

				                <div align="center">
				                    <button type="submit" class="btn btn-success">Sua</button>
				                </div>
				            </form>
			            </div>
			        </div>
			    </div>
			</div>
			@if(count($errors)>0 || Session::has('suathanhcong') || Session::has('loianh') || Session::has('loinamsinh'))
			<script type="text/javascript">
				$(document).ready(function(){
					$("#SuaThongTin").modal();
				})
			</script>
			@endif

			@elseif(isset($cthdv))
				<div class="panel-heading" style="background-color:#337AB7; color:white;" >
					<h2 style="margin-top:0px; margin-bottom:0px; text-align: center;"> Thong tin HDV</h2>
				</div>

				<div class="panel-body">
					@foreach($cthdv as $ct)
					<div class="row-item row">
						<div class="col-md-12 border-right">
							<div class="col-md-9 col-sm-9 col-xs-9">
								<h3>
									Ho ten: <a>{{$ct->hoten}}</a>
								</h3>
								<p>Email: {{$ct->email}}<p>
								@if($ct->namsinh != "")
								<p>Nam sinh: {{$ct->namsinh}}</p>
								@endif

								@if($ct->gioitinh != "")
								<p>Gioi tinh: {{$ct->gioitinh}}</p>
								@endif

								@if($ct->anhdaidien != "")
								<p>Anh dai dien:<br> <img src="upload/{{$ct->anhdaidien}}" width="200" height="200"></p>
								@endif

								<p>Dia chi: {{$ct->diachi}}</p>
								<p>So dien thoai: {{$ct->sodienthoai}}</p>
								<a class="btn btn-primary" href="{{route('tour_hdv',$ct->id)}}">Xem cac tour da mo<span class="glyphicon glyphicon-chevron-right"></span></a>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			@endif
		</div>
	</div>
</div>

@endsection
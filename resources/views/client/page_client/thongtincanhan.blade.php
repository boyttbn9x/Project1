@extends('client.layout_client.master_client')
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

						@if($user->gioitinh == 1)
							<p>Gioi tinh: Nam</p>
						@elseif($user->gioitinh === 0)
							<p>Gioi tinh: Nu</p>
						@endif

						@if($user->anhdaidien != "")
						<p>Anh dai dien:<br> <img src="upload/{{$user->anhdaidien}}" width="200" height="200"></p>
						@endif

						@if($user->diachi != "")
							<p>Dia chi: {{$user->diachi}}</p>
						@endif
						<p>So dien thoai: {{$user->sodienthoai}}</p>
						<a class="btn btn-primary" href="" data-toggle="modal" data-target="#SuaThongTin">Sua thong tin <span class="glyphicon glyphicon-chevron-right"></span></a>
					</div>
				</div>
			</div>
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

								@if($ct->gioitinh == 1)
									<p>Gioi tinh: Nam</p>
								@elseif($ct->gioitinh === 0)
									<p>Gioi tinh: Nu</p>
								@endif

								@if($ct->anhdaidien != "")
									<p>Anh dai dien:<br> <img src="upload/{{$ct->anhdaidien}}" width="200" height="200"></p>
								@endif

								@if($ct->diachi != "")
									<p>Dia chi: {{$ct->diachi}}</p>
								@endif

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
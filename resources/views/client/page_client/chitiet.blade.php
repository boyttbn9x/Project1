@extends('client.layout_client.master_client')
@section('thongbao')
	@if(session('errorRate'))
		<div class="alert alert-danger col-md-6 col-md-offset-3 text-center">
	        {{Session::get('errorRate')}}
	    </div>
	@endif
	@if(session('successRate'))
		<div class="alert alert-success col-md-6 col-md-offset-3 text-center">
	        {{Session::get('successRate')}}
	    </div>
	@endif
@endsection

@section('content')
<div class="col-md-9 col-xs-9 col-sm-9" style="background-color: white">
	<h1 class="title text-center" style="color: orange; margin-top: 20px">{{$cttour->tentour}}</h1>
	<div class="panel-body">	
		<div class="col-md-12 border-right">
			<div class="col-md-11 col-xs-11">
				<p>Huong dan vien: <a href="{{route('tthdv',$cttour->users_id)}}"> {{$cttour->users->hoten}}</a><p>
				<p>Dia diem: {{$cttour->diadiem->tendiadiem}}<p>
				<p>So khach toi da: {{$cttour->sokhachmax}}</p>
				<p>Gia tour: {{ number_format($cttour->giatour) }} VND</p>

				@if($cttour->hinhanh != '')
				<p><img  class= "img-responsive" src="upload/{{$cttour->hinhanh}}" height="600" width="600"></p>
				@endif

				<p>Mo ta: {!! $cttour->mota !!}</p><br><br>

				@if(count($cttour->imagetour)>0)
					<span style="display: block;">Cac hinh anh khac:</span>
					@foreach($cttour->imagetour as $imt)
					<a href="" data-toggle="modal" data-target="#imt{{$imt->id}}" style="float: left">
						<img src="upload/{{$imt->image}}" height="100" width="100" style="margin: 5px; border: 1px solid red">
					</a>

					<div class="modal" id="imt{{$imt->id}}">
					    <div class="modal-dialog modal-lg">
					        <div class="modal-content">
					            <div class="modal-body">
					            	<img class= "img-responsive" src="upload/{{$imt->image}}" width="1000" />
					            </div>
					        </div>
					    </div>
					</div>
					@endforeach
					<div style="clear: both"></div>
				@endif

				@if(Auth::check())
					<?php $co = true ?>
					@foreach($cttour->bill as $bll)
						@if(($bll->tinhtrangdon == 0 || $bll->tinhtrangdon == 1 || $bll->tinhtrangdon == 3) && $bll->users_id == Auth::user()->id)
							<?php $co = false ?>
						@endif
					@endforeach

					@if($co == false)
						<a class="btn btn-primary">Ban da dat tour nay</a>
					@else
						@if(Auth::user()->quyen == 1)
							<a class="btn btn-primary" data-toggle="modal" data-target="#DatTour">Dat tour<span class="glyphicon glyphicon-chevron-right"></span></a>	
						@endif
					@endif
				@else
				<a class="btn btn-primary" href="" data-toggle="modal" data-target="#DangNhap">Dat tour<span class="glyphicon glyphicon-chevron-right"></span></a>
				@endif
			</div>
			<div style="clear: both;"></div>
		</div>
		@include('client.page_client.nhanxet')
	</div>	
</div>
@endsection

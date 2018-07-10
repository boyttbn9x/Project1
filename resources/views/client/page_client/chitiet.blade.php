@extends('client.layout_client.master_client')
@section('content')

<div class="col-md-9 col-xs-9 col-sm-9">
	<div class="panel panel-default">
		<div class="panel-heading" style="background-color:#337AB7; color:white;" >
			<h2 style="margin-top:0px; margin-bottom:0px; text-align: center;"> Chi tiet tour</h2>
		</div>

		<div class="panel-body">
			@if(session('errorRate'))
				<div class="alert alert-danger" style="width: 60%">
		            {{Session::get('errorRate')}}
		        </div>
			@endif
			@if(session('successRate'))
				<div class="alert alert-success" style="width: 60%">
		            {{Session::get('successRate')}}
		        </div>
			@endif
			
			<div class="row-item row">
				<div class="col-md-12 border-right">
					<div class="col-md-11 col-xs-11">
						<h3>{{$cttour->tentour}}</h3>
						<p>Huong dan vien: <a href="{{route('tthdv',$cttour->users_id)}}"> {{$cttour->users->hoten}}</a><p>
						<p>Dia diem: {{$cttour->diadiem->tendiadiem}}<p>
						<p>So khach toi da: {{$cttour->sokhachmax}}</p>
						<p>Gia tour: {{ number_format($cttour->giatour) }} VND</p>
						<p><img  class= "img-responsive" src="upload/{{$cttour->hinhanh}}" height="600" width="600" alt=""></p>
						<p>Mo ta: {{$cttour->mota}}</p><br><br>

						@if(count($cttour->imagetour)>0)
							<p>Cac hinh anh khac:</p>
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
						<br>

						@if(Auth::check())
							<?php $co = true ?>
							@foreach($cttour->bill as $bll)
								@if(($bll->tinhtrangdon == 0 && $bll->users_id == Auth::user()->id) || ($bll->tinhtrangdon == 1 && $bll->users_id == Auth::user()->id))
									<?php $co = false ?>
								@endif
							@endforeach

							@if($co == false)
								<a class="btn btn-primary">Ban da dat tour nay</a>
							@else
								@if(Auth::user()->quyen == 2 ||Auth::user()->quyen == 3)
								@else
								<a class="btn btn-primary" data-toggle="modal" data-target="#DatTour">Dat tour<span class="glyphicon glyphicon-chevron-right"></span></a>	
								@endif
							@endif
						@else
						<a class="btn btn-primary" href="" data-toggle="modal" data-target="#DangNhap">Dat tour<span class="glyphicon glyphicon-chevron-right"></span></a>
						@endif
					</div>

					<div style="clear: both; height: 20px"></div>
				</div>
			</div>
		</div>	
		@include('client.page_client.nhanxet')
	</div>
</div>
@endsection

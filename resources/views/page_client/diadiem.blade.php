@extends('master_client')
@section('content')

<div class="col-md-9 col-sm-9 col-xs-9">
	<div class="panel panel-default">
		<div class="panel-heading" style="background-color:#337AB7; color:white;" >	
			<h2 style="margin-top:0px; margin-bottom:0px; text-align: center;">Dia diem {{$idd->tendiadiem}}</b></h2>
		</div>

		<div class="panel-body">
		@foreach($idd->tour as $t)
			<div class="row-item row">
				<div class="col-md-12 border-right">
					<div class="col-md-3 col-xs-4">
						@if($t->hinhanh)
						<img src="upload/{{$t->hinhanh}}" width="150" height="110" alt="" style="margin-top: 30px">
						@else
						<img src="dulich/image/noimage.png" width="150" height="110" alt="" style="margin-top: 30px">
						@endif
					</div>
					<div class="col-md-9 col-xs-8">
						<h4><a>{{$t->tentour}}</a></h4>
						Huong dan vien:<a href="{{route('tthdv',$t->users_id)}}"> {{$t->users->hoten}}</a>
						<p>Dia diem: {{$idd->tendiadiem}}</p>	
						<p>Gia: {{$t->giatour}}</p>
						<a class="btn btn-primary" href="{{route('chi-tiet',$t->id)}}">Chi tiet<span class="glyphicon glyphicon-chevron-right"></span></a>
					</div>
				</div>
			</div>
			<hr>
			@endforeach
		</div>
	</div>
</div>

@endsection
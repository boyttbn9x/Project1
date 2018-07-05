@extends('master_client')
@section('content')

<div class="col-md-9 col-ms-9 col-xs-9">
	<div class="panel panel-default">
		<div class="panel-heading" style="background-color:#337AB7; color:white;" >
			<h2 style="margin-top:0px; margin-bottom:0px; text-align: center;"> Danh sách tour</h2>
		</div>

		<div class="panel-body">
			<!-- item -->
			@foreach($tour as $t)
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
						<p>Huong dan vien:<a> {{$t->hoten}}</a></p>
						<p>Dia diem: {{$t->tendiadiem}}<br>
							
						<p>Gia tour: {{number_format($t->giatour)}} VND</p>
						<a class="btn btn-primary" href="{{route('chitiet',$t->id)}}">Chi tiet<span class="glyphicon glyphicon-chevron-right"></span></a>
					</div>
				</div>
			</div>
			<hr>
			<!-- end item -->
			@endforeach

			<div align="center">
				{{$tour->links()}}
			</div>

		</div>
	</div>
</div>

@endsection
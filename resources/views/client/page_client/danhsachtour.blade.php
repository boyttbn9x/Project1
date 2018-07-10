@extends('client.layout_client.master_client')
@section('content')

<div class="col-sm-9 col-md-9 col-xs-9">
	<div class="features_items">
		@if(isset($tourdiadiem))
			<h1 class="title text-center" style="color: orange">Dia diem {{$tourdiadiem->tendiadiem}}</h1>
			@foreach($tourdiadiem->tour as $t)
			<div class="col-md-4 col-sm-6 col-xs-6">
				<div class="product-image-wrapper">
					<div class="single-products">
						<div class="productinfo text-center">
							@if($t->hinhanh != '')
								<img src="upload/{{$t->hinhanh}}" style="width:200px;height:160px">
							@else
								<img src="dulich/image/noimage.png" style="width:200px;height:160px">
							@endif
							<div style="height: 60px">
								<h4 style="color: orange">{{$t->tentour}}</h4>		
							</div>								
						</div>
						<div class="product-overlay">
							<div class="overlay-content">
								<h2 style="color: white">{{number_format($t->giatour)}} vnđ</h2>
								<a href="{{route('chi-tiet',$t->id)}}" class="btn btn-default" style="margin-bottom: 60px;">Chi tiet</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
			@if($tourdiadiem->tour->count() == 0) 
				<h1 style="color: blue" align="center">Hien chua co tour tai dia diem nay</h1>
			@endif
		@elseif(isset($tourtimkiem))
			<h1 class="title text-center" style="color: orange">Tim thay {{$count}} ket qua</h1>
			@foreach($tourtimkiem as $t)
			<div class="col-md-4 col-sm-6 col-xs-6">
				<div class="product-image-wrapper">
					<div class="single-products">
						<div class="productinfo text-center">
							@if($t->hinhanh != '')
								<img src="upload/{{$t->hinhanh}}" style="width:200px;height:160px">
							@else
								<img src="dulich/image/noimage.png" style="width:200px;height:160px">
							@endif
							<div style="height: 60px">
								<h4 style="color: orange">{{$t->tentour}}</h4>		
							</div>								
						</div>
						<div class="product-overlay">
							<div class="overlay-content">
								<h2 style="color: white">{{number_format($t->giatour)}} vnđ</h2>
								<a href="{{route('chi-tiet',$t->id)}}" class="btn btn-default" style="margin-bottom: 60px;">Chi tiet</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
			<div class="row" align="center">{{$tourtimkiem->links()}}</div>
		@elseif(isset($tourhdv))
			<h1 class="title text-center" style="color: orange">Danh sach tour cua huong dan vien</h1>
			@foreach($tourhdv as $t)
			<div class="col-md-4 col-sm-6 col-xs-6">
				<div class="product-image-wrapper">
					<div class="single-products">
						<div class="productinfo text-center">
							@if($t->hinhanh != '')
								<img src="upload/{{$t->hinhanh}}" style="width:200px;height:160px">
							@else
								<img src="dulich/image/noimage.png" style="width:200px;height:160px">
							@endif
							<div style="height: 60px">
								<h4 style="color: orange">{{$t->tentour}}</h4>		
							</div>								
						</div>
						<div class="product-overlay">
							<div class="overlay-content">
								<h2 style="color: white">{{number_format($t->giatour)}} vnđ</h2>
								<a href="{{route('chi-tiet',$t->id)}}" class="btn btn-default" style="margin-bottom: 60px;">Chi tiet</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
			<div class="row" align="center">{{$tourhdv->links()}}</div>
		@elseif(isset($tour))
			<h1 class="title text-center" style="color: orange">Danh sach tour</h1>
			@foreach($tour as $t)
			<div class="col-md-4 col-sm-6 col-xs-6">
				<div class="product-image-wrapper">
					<div class="single-products">
						<div class="productinfo text-center">
							@if($t->hinhanh != '')
								<img src="upload/{{$t->hinhanh}}" style="width:200px;height:160px">
							@else
								<img src="dulich/image/noimage.png" style="width:200px;height:160px">
							@endif
							<div style="height: 60px">
								<h4 style="color: orange">{{$t->tentour}}</h4>		
							</div>								
						</div>
						<div class="product-overlay">
							<div class="overlay-content">
								<h2 style="color: white">{{number_format($t->giatour)}} vnđ</h2>
								<a href="{{route('chi-tiet',$t->id)}}" class="btn btn-default" style="margin-bottom: 60px;">Chi tiet</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
			<div class="row" align="center">{{$tour->links()}}</div>
		@endif
	</div>
</div>

@endsection
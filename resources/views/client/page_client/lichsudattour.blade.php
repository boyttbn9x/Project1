@extends('client.layout_client.master_client')
@section('thongbao')
	@if(Session::has('thanhcongTT'))
		<div class="alert alert-success col-md-6 col-md-offset-3 text-center">
        {{Session::get('thanhcongTT')}}
        </div>
    @endif
@endsection
	
@section('content')
<div class="col-md-9 col-xs-9 col-sm-9">
	<div class="panel panel-default">		
		@if(count($lichsu)>0)
		<div class="panel-heading" style="background-color:#337AB7; color:white;" >
			<h2 style="margin-top:0px; margin-bottom:0px; text-align: center;"> Danh sach don dat tour</h2>
		</div>
		<div class="panel-body">
			@foreach($lichsu as $ls)
			<div class="row-item row">
				<div class="col-md-12 border-right">
					<div class="col-md-3 col-xs-4">
						@if($ls->tour->hinhanh)
						<img src="upload/{{$ls->tour->hinhanh}}" width="150" height="110" alt="" style="margin-top:10px">
						@else
						<img src="dulich/image/noimage.png" width="150" height="110" alt="" style="margin-top:10px">
						@endif
					</div>
					<div class="col-md-9 col-xs-8">
						<h4><a href="{{route('chi-tiet',$ls->tour_id)}}">{{$ls->tour->tentour}}</a></h4>
						
						<p>Huong dan vien: {{$ls->users->email}}</p>
						<p>Tong tien: {{number_format($ls->tongtien)}} VND</p>
						<p>Trang thai don: 
							@if($ls->tinhtrangdon == 0)
								<a>Chua xu ly</a>
							@elseif($ls->tinhtrangdon == 1)
								<a>Duoc chap nhan</a>
								<form action="{{url('payment')}}" method="POST" role="form">
				                    {{csrf_field()}}
				                    <input type="hidden" name="idbill" value="{{$ls->id}}">
				                    <input type="hidden" name="tentour" value="{{$ls->tour->tentour}}">
				                    <input type="hidden" name="tongtien" value="{{$ls->tongtien}}">
				                    <button type="submit" style="color: red; padding: 7px; background: #ffffb3">Thanh toan</button>
				                </form>
							@elseif($ls->tinhtrangdon == 2)
								<a style="color: red"><i class="glyphicon glyphicon-remove"></i> Bi tu choi</a>
							@elseif($ls->tinhtrangdon == 3)
								<a style="color: green"><i class="glyphicon glyphicon-ok"></i> Da thanh toan</a>
							@elseif($ls->tinhtrangdon == 4) 
                                <a style="color: #00FA9A"><i class="glyphicon glyphicon-ok"></i> Thanh cong</a>
							@endif
						</p>
					</div>
				</div>
			</div>
			<hr>
			@endforeach

			<div class="row" style="text-align: center">
				{{$lichsu->links()}}
			</div>

		</div>
		@else
			<div class="panel-heading" style="background-color:#337AB7; color:white;" >
				<h2 style="margin-top:0px; margin-bottom:0px; text-align: center;"> Hien tai ban chua co don dat tour nao</h2>
			</div>
		@endif
	</div>
</div>

@endsection
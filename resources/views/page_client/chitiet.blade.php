@extends('master_client')
@section('content')

<div class="col-md-9 col-xs-9 col-ms-9">

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
					<div class="col-md-9">
						<h3>{{$cttour->tentour}}</h3>
						<p>Huong dan vien: <a href="{{route('tthdv',$cttour->users_id)}}"> {{$cttour->hoten}}</a><p>
						<p>Dia diem: {{$cttour->tendiadiem}}<p>
						<p>So khach toi da: {{$cttour->sokhachmax}}</p>
						<p>Gia tour: {{ number_format($cttour->giatour) }} VND</p>
						<p><img  class= "img-responsive" src="upload/{{$cttour->hinhanh}}" height="600" width="600" alt=""></p>
						<p>Mo ta: {{$cttour->mota}}</p><br><br>

						@if(count($image)>0)
							<p>Cac hinh anh khac:</p>
							@foreach($image as $im)
								<p><img  class= "img-responsive" src="upload/{{$im->image}}" height="400" width="400" alt=""></p>
							@endforeach
						@endif
						<br><br>

						@if(session('successDatTour'))
	                	<script type="text/javascript">
	             			alert('Dat tour thanh cong.');
	                	</script>
	                	@endif

						@if(Auth::check())
							@if(count($checkBill)>0)
								<a class="btn btn-primary">Ban da dat tour nay</a>
							@else
								<a class="btn btn-primary" href="" data-toggle="modal" data-target="#DatTour">Dat tour<span class="glyphicon glyphicon-chevron-right"></span></a>

								<div class="modal" id="DatTour">
								    <div class="modal-dialog">
								        <div class="modal-content">
								            <button type="button" class="btn btn-danger" data-dismiss="modal" style="float: right; padding: 3px 20px; font-weight: bold;">X</button>
								            <!-- Modal Header -->
								            <div class="modal-header" style="background-color: #66FFFF">  
								                <div align="center" style="font-size: 32px; font-weight: bold; color: red">Dat Tour</div>
								            </div>

								            <!-- Modal body -->
								            <div class="modal-body">

								                <form action="{{route('dattour',$cttour->id)}}" method="POST">

								                    <fieldset style="color: blue; font-style: italic;">
								                    	<input type="hidden" name="_token" value="{{csrf_token()}}">

										    			<label>Ten tour</label>
													  	<input type="text" class="form-control" readonly="" name="tentour" value="{{$cttour->tentour}}">
														<br>

										    			<label>Dia diem</label>
													  	<input type="text" class="form-control" readonly="" name="tendiadiem" value="{{$cttour->tendiadiem}}">
														<br>
											    			
										    			<label>Gia tien</label>
													  	<input type="text" class="form-control" readonly="" name="giatour" value="{{$cttour->giatour}}">
													  	<br>

										    			<label>Thoi gian bat dau</label>
										    			<span style="color: red">{{$errors->first('timeBD')}}</span>
													  	<input type="text" class="form-control" placeholder="Nhap theo dang YYYY-MM-dd" name="timeBD" value="{{old('timeBD')}}">
														<br>
											    			
										    			<label>So luong nguoi dang ky</label>
										    			<span style="color: red">
										    				{{$errors->first('sokhachdangky')}}
										    				@if(session('loi'))
										    					{{Session::get('loi')}}
										    				@endif
										    			</span>			
													  	<input type="text" class="form-control" name="sokhachdangky"  value="{{old('sokhachdangky')}}">
														<br>

														<input type="hidden" class="form-control" name="idkhach" value="{{Auth::user()->id}}">
														<br>

								                        <div align="center"><button type="submit" class="btn btn-lg btn-success btn-block" style="width: 20%">Dat tour</button></div>
								                    </fieldset>
								                </form>
								            </div>
								        </div>
								    </div>
								</div>
								@if(count($errors)>0)
								    @if(Session::has('errorDatTour'))
									    <script>
									        $(document).ready(function(){
									            $("#DatTour").modal();
									        });
									    </script>
									@endif
								@endif
								@if(session('loi'))
									<script>
								        $(document).ready(function(){
								            $("#DatTour").modal();
								        });
								    </script>
								@endif
							@endif
						@else
						<a class="btn btn-primary" href="" data-toggle="modal" data-target="#DangNhap">Dat tour<span class="glyphicon glyphicon-chevron-right"></span></a>
						@endif
					</div>

					<div style="clear: both; height: 20px"></div>
					<span style="font-size: 25px; ">Danh gia:</span>
						@if(count($rate)>0)
							<?php
							$count = count($rate);
							$sum = 0;
							?>
							@foreach($rate as $rt)
								<?php
									$sum += $rt->sodiem;
								?>
							@endforeach
							
							<?php
								$sosao = round($sum/$count,2);
								if($sosao < 1.5){
									echo '<i class="glyphicon glyphicon-star" style="color: yellow;"></i>'.'<i class="glyphicon glyphicon-star-empty" style="color: yellow;"></i>'.'<i class="glyphicon glyphicon-star-empty" style="color: yellow;"></i>'.'<i class="glyphicon glyphicon-star-empty" style="color: yellow;"></i>'.'<i class="glyphicon glyphicon-star-empty" style="color: yellow;"></i>';
								}elseif($sosao < 2.5){
									echo '<i class="glyphicon glyphicon-star" style="color: yellow;"></i>'.'<i class="glyphicon glyphicon-star" style="color: yellow;"></i>'.'<i class="glyphicon glyphicon-star-empty" style="color: yellow;"></i>'.'<i class="glyphicon glyphicon-star-empty" style="color: yellow;"></i>'.'<i class="glyphicon glyphicon-star-empty" style="color: yellow;"></i>';
								}elseif($sosao < 3.5){
									echo '<i class="glyphicon glyphicon-star" style="color: yellow;"></i>'.'<i class="glyphicon glyphicon-star" style="color: yellow;"></i>'.'<i class="glyphicon glyphicon-star" style="color: yellow;"></i>'.'<i class="glyphicon glyphicon-star-empty" style="color: yellow;"></i>'.'<i class="glyphicon glyphicon-star-empty" style="color: yellow;"></i>';
								}elseif($sosao < 4.5){
									echo '<i class="glyphicon glyphicon-star" style="color: yellow;"></i>'.'<i class="glyphicon glyphicon-star" style="color: yellow;"></i>'.'<i class="glyphicon glyphicon-star" style="color: yellow;"></i>'.'<i class="glyphicon glyphicon-star" style="color: yellow;"></i>'.'<i class="glyphicon glyphicon-star-empty" style="color: yellow;"></i>';
								}else{
									echo '<i class="glyphicon glyphicon-star" style="color: yellow;"></i>'.'<i class="glyphicon glyphicon-star" style="color: yellow;"></i>'.'<i class="glyphicon glyphicon-star" style="color: yellow;"></i>'.'<i class="glyphicon glyphicon-star" style="color: yellow;"></i>'.'<i class="glyphicon glyphicon-star" style="color: yellow;"></i>';
								}
								echo '<span style="font-size: 25px; margin-left: 10px">'. $sosao.'</span>';
								echo '<span style="font-size: 20px; margin-left: 10px; color:#A9A9A9">'.'( '. $count.' luot danh gia)'.'</span>';
							?>
						@else
							<span style="color:#A9A9A9">Hien chua co luot danh gia nao.</span>
						@endif

						@if(Auth::check())
							@if(count($bill)>0)
								@foreach($bill as $bll)
									@if($bll->users_id == Auth::user()->id)
										@if(count($checkRate)==0)
										<div class="col-md-9" style="margin-top: 10px">
											<a>Danh gia tour: </a>
											<form action="danh-gia-{{$cttour->id}}" method="post">
												<input type="hidden" name="_token" value="{{csrf_token()}}" >  
												<select name="sodiem">
													<option value="0">Chon so diem danh gia</option>
													<option value="1">1 sao</option>
													<option value="2">2 sao</option>
													<option value="3">3 sao</option>
													<option value="4">4 sao</option>
													<option value="5">5 sao</option>
												</select>
												<button type="submit">Gui</button>
											</form>
										</div>
										@else
										<div class="col-md-9" style="margin-top: 10px; color: #A9A9A9">Ban da danh gia @foreach($checkRate as $cR) {{$cR->sodiem}} @endforeach sao cho tour nay.</div>
										@endif
									@break	
									@endif
								@endforeach
							@endif
						@endif

				</div>
			</div>
		</div>	

		<div class="col-sm-12" style="margin-top: 30px">			
			<ul class="nav nav-tabs">
				<li><a href="#reviews" data-toggle="tab">Bình luận</a></li>
			</ul>
		</div>

		<div class="tab-pane fade active in" id="reviews" >
			<div class="col-sm-12">
				@foreach($comment as $cm)
				<div class="comment">
				<ul>			
					<li>
						<a><i class="fa fa-user"></i>{{$cm->email}}</a>
						<a style="margin-left: 5px"><i class="fa fa-clock-o"></i>{{$cm->created_at}}</a>

						@if(count($bill)>0)
							@foreach($bill as $bll)
								@if($bll->users_id == $cm->users_id)
									<a style="color:#A9A9A9">( Da di tour nay )</a>
									@break	
								@endif
							@endforeach
						@endif
						@if($cm->users_id == $cttour->users_id)
							<a style="color:#00ffff">( Chu tour )</a>
						@endif

						<br>{{$cm->noidung}}<br>
						@foreach($traloi as $tl)
						@if($tl->parent_id == $cm->id)
							<div>
								<ul style="list-style: none">
									<a><i class="fa fa-user"></i>{{$tl->email}}</a>
									<a style="margin-left: 5px"><i class="fa fa-clock-o"></i>{{$tl->created_at}}</a>

									@if(count($bill)>0)
										@foreach($bill as $bll)
											@if($bll->users_id == $tl->users_id)
												<a style="color:#A9A9A9">( Da di tour nay )</a>
												@break	
											@endif
										@endforeach
									@endif

									@if($tl->users_id == $cttour->users_id)
										<a style="color:#00ffff">( Chu tour )</a>
									@endif

									<br>{{$tl->noidung}}<br>
								</ul>
							</div>
						@endif
						@endforeach 

						@if(Auth::check())
						<a href="{{route('tra-loi',$cm->id)}}" style="margin-left: 40px ">Tra loi</a>
						@endif
					</li>
							
				</ul>	
				</div>
				
				@endforeach
				<div class="row" style="text-align: center">
					{{$comment->links()}}
				</div>
				
				<div class="send" style="padding-top: 20px;">
					@if(count($errors)>0)
				        <div class="alert alert-danger">
				            @foreach($errors->all() as $err)
				                {{$err}}<br>
				            @endforeach
				        </div>
					@endif
					@if(Auth::check())
					<p style="margin-left: 40px"><b>Gửi cau hoi hoac nhan xet của bạn về tour</b></p>
					<form action="binh-luan-{{$cttour->id}}" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}" >
						
						<div align="center">
							<textarea name="noidung" rows="5" cols="100" style="border-radius: 5px"></textarea>
							<button type="submit">
								Gui binh luan
							</button>
					</form>
					@endif
					<br><br>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
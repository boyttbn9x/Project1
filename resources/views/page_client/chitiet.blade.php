@extends('master_client')
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
													  	<input type="text" class="form-control" readonly="" name="tendiadiem" value="{{$cttour->diadiem->tendiadiem}}">
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
				</div>
			</div>
		</div>	

		<div class="col-sm-12" style="margin-top: 30px">			
			<ul class="nav nav-tabs">
				<li><a href="#reviews" data-toggle="tab" id="bl">Bình luận</a></li>
				<li><a href="#danhgia" data-toggle="tab" id="dg">Danh gia</a></li>
			</ul>
			<br>
		</div>

		@if(Session::has('successRate'))
			<script type="text/javascript">
				$('#danhgia').show();
			</script>
		@endif

		<div id="danhgia" style="display: none">
			<div class="col-sm-12">
				@if($cttour->rate->count() > 0)				
					<?php
						$sosao = round($cttour->rate->avg('sodiem'), 2);
						for ($i=1; $i <= 5 ; $i++) { 
							if ($i <= $sosao) {
								echo '<i class="glyphicon glyphicon-star" style="color: yellow;"></i>';
							}else{
								echo '<i class="glyphicon glyphicon-star" style="color: #DDDDDD;"></i>';
							}
						}					
						echo '<span style="font-size: 25px; margin-left: 10px">'.$sosao.'</span>';
						echo '<span style="font-size: 20px; margin-left: 10px; color:#A9A9A9">'.'( '. $cttour->rate->count().' luot danh gia)'.'</span>';
					?>
				@else
					<span style="color:#A9A9A9">Hien chua co luot danh gia nao.</span>
				@endif

				<?php $flag =true ?>
				@if(Auth::check())
					@foreach($cttour->bill as $bll)
						@if($bll->users_id == Auth::user()->id && $bll->tinhtrangdon == 3 )
							@foreach($cttour->rate as $rate)
								@if($rate->users_id == Auth::user()->id)
									<?php $flag = false ?>
									<div class="row">
										<div class="col-md-9" style="margin-top: 10px; color: #A9A9A9">Ban da danh gia {{$rate->sodiem}} sao cho tour nay.</div><br><br><br>
									</div>	
									@break
								@endif
							@endforeach
							@if($flag == true)
								<div class="col-md-9" style="margin-top: 10px">
									<a>Danh gia tour: </a>
									<form action="danh-gia-{{$cttour->id}}" method="post">
										<input type="hidden" name="_token" value="{{csrf_token()}}" >  
										<div style="float: left;">
											<i class="glyphicon glyphicon-star" id="dg1" style="color: #DDDDDD;"></i>
											<i class="glyphicon glyphicon-star" id="dg2" style="color: #DDDDDD;"></i>
											<i class="glyphicon glyphicon-star" id="dg3" style="color: #DDDDDD;"></i>
											<i class="glyphicon glyphicon-star" id="dg4" style="color: #DDDDDD;"></i>
											<i class="glyphicon glyphicon-star" id="dg5" style="color: #DDDDDD;"></i>
										</div>
										<input type="hidden" name="sodiem" value="0" id="sodiemdanhgia">
										<button type="submit" style="margin-left: 25px;">Gui</button>
									</form>
									<br><br>
								</div>
							@endif									
						@break	
						@endif
					@endforeach
				@endif
			</div>
		</div>

		<div id="reviews" style="display: none">
			<div class="col-sm-12">
				<div class="comment">
				@foreach($cttour->comment as $cm)						
					@if($cm->parent_id == 0)
					<ul>
						<li>
							<a><i class="fa fa-user"></i> {{$cm->users->email}}</a>
							<a style="margin-left: 5px"><i class="fa fa-clock-o"></i> {{$cm->created_at}}</a>

							@foreach($cttour->bill as $bll)
								@if($bll->users_id == $cm->users_id && $bll->tinhtrangdon == 3)
									<a style="color:#A9A9A9">( Da di tour nay )</a>
									@break	
								@endif
							@endforeach
							@if($cm->users_id == $cttour->users_id)
								<a style="color:#00ffff">( Chu tour )</a>
							@endif
							<br>{{$cm->noidung}}
						</li>
					</ul>
					@endif

						@foreach($cttour->comment as $tl)
							@if($tl->parent_id == $cm->id)
								<div>
									<ul style="list-style: none; margin-left: 30px;">
										<a><i class="fa fa-user"></i>{{$tl->users->email}}</a>
										<a style="margin-left: 5px"><i class="fa fa-clock-o"></i>{{$tl->created_at}}</a>

										@foreach($cttour->bill as $bll)
											@if($bll->users_id == $tl->users_id && $bll->tinhtrangdon == 3)
												<a style="color:#A9A9A9">( Da di tour nay )</a>
												@break	
											@endif
										@endforeach

										@if($tl->users_id == $cttour->users_id)
											<a style="color:#00ffff">( Chu tour )</a>
										@endif
										<br>{{$tl->noidung}}
									</ul>
								</div>
							@endif
						@endforeach 

						@if(Auth::check() && $cm->parent_id ==0)
						<a style="margin-left: 90px" href="#tlbl{{$cm->id}}" class="tlbl" data-toggle ="tab">Tra loi</a>
						@if(Session::has('errorReply'))
							<script type="text/javascript">
								$('#reviews').show();
							</script>
						@endif
						@if(Session::has('successReply'))
					        <script type="text/javascript">
					        	$('#reviews').show();
					        </script>
						@endif
						<div id="tlbl{{$cm->id}}" style="display: none;" class="traloi">
							<form method="post" action="{{route('tra-loi',$cm->id)}}">
					            <input type="hidden" name="_token" value="{{csrf_token()}}" >           
					            <div class="form-group">
					                <input type="text" class="form-control" name="traloi" style="width: 80%; float: left; margin-left: 90px">
					                <button type="submit" class="btn btn-success">Gui</button>
					            </div>	            	
					        </form>
						</div>
					@endif						
				@endforeach
				</div>
				
				<div class="send" style="padding-top: 20px;">
					@if(Session::has('errorComment'))
				        <script type="text/javascript">
				        	alert('Vui long nhap binh luan.');
				        	$('#reviews').show();
				        </script>
					@endif
					@if(Session::has('successComment'))
				        <script type="text/javascript">
				        	$('#reviews').show();
				        </script>
					@endif

					@if(Auth::check())
					<p style="margin-left: 40px"><b>Gửi cau hoi hoac nhan xet của bạn về tour</b></p>
					<form action="binh-luan-{{$cttour->id}}" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}" >
						
						<div align="center">
							<textarea name="noidung" rows="5" cols="100" style="border-radius: 5px"></textarea>
							<button type="submit">Gui binh luan</button>
						</div>
					</form>
					@endif
					<br><br>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

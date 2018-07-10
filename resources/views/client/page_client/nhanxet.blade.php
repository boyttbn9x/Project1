<div class="col-sm-12" style="margin-top: 30px">			
	<ul class="nav nav-tabs">
		<li><a href="#reviews" data-toggle="tab" id="bl">Bình luận</a></li>
		<li><a href="#danhgia" data-toggle="tab" id="dg">Danh gia</a></li>
	</ul>
	<br>
</div>

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
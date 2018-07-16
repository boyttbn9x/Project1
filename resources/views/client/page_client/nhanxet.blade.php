<div class="col-sm-12" style="margin-top: 20px">			
	<ul class="nav nav-tabs">
		<li><a href="#reviews" data-toggle="tab" id="bl">Bình luận</a></li>
		<li><a href="#danhgia" data-toggle="tab" id="dg">Danh gia</a></li>
	</ul>
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
			<span style="color:#A9A9A9; display: block;">Hien chua co luot danh gia nao.</span>
		@endif

		<?php $flag =true ?>
		@if(Auth::check())
			@foreach($cttour->bill as $bll)
				@if($bll->users_id == Auth::user()->id && $bll->tinhtrangdon == 4)
					@foreach($cttour->rate as $rate)
						@if($rate->users_id == Auth::user()->id)
							<?php $flag = false ?>
							<div class="row">
								<div class="col-md-9" style="margin-top: 10px; color: #A9A9A9">Ban da danh gia {{$rate->sodiem}} sao cho tour nay.</div><br>
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
		<div class="dsbinhluan">
		@foreach($cttour->comment as $cm)						
			@if($cm->parent_id == 0)
				<div style="margin-left: 50px">
					<a><i class="fa fa-user"></i> {{$cm->users->email}}</a>
					<a style="margin-left: 5px"><i class="fa fa-clock-o"></i> {{$cm->created_at}}</a>

					@foreach($cttour->bill as $bll)
						@if($bll->users_id == $cm->users_id && $bll->tinhtrangdon == 4)
							<a style="color:#A9A9A9">( Da di tour nay )</a>
							@break	
						@endif
					@endforeach
					@if($cm->users_id == $cttour->users_id)
						<a style="color:#00ffff">( Chu tour )</a>
					@endif

					@if($cm->trangthaibinhluan == 1)
						<span style="display:block; color: red"><<<< Binh luan da bi an. >>>></span>
					@else
						<?php
							$string ="";
							$dem = 0;
							for($i=0; $i < strlen($cm->noidung); $i++){
								$dem++;
								if ($dem % 65 == 0) {
									$string .= "<br>";
									$i--;
								}else{
									$string .= $cm->noidung[$i];
								}
								if($cm->noidung[$i] == " "){
									$dem =0;
								}
							}
							echo '<span style="display:block">'.$string.'</span>';
						?>
					@endif
				</div>
			@endif

			<div id="dstraloi{{$cm->id}}">
				<div class="col-md-11 col-xs-11 col-md-offset-1 col-xs-offset-1">
				@foreach($cttour->comment as $tl)
					@if($tl->parent_id == $cm->id)					
						<a><i class="fa fa-user"></i>{{$tl->users->email}}</a>
						<a style="margin-left: 5px"><i class="fa fa-clock-o"></i>{{$tl->created_at}}</a>

						@foreach($cttour->bill as $bll)
							@if($bll->users_id == $tl->users_id && $bll->tinhtrangdon == 4)
								<a style="color:#A9A9A9">( Da di tour nay )</a>
								@break	
							@endif
						@endforeach

						@if($tl->users_id == $cttour->users_id)
							<a style="color:#00ffff">( Chu tour )</a>
						@endif
						<?php
							$string ="";
							$dem = 0;
							for($i=0; $i < strlen($tl->noidung); $i++){
								$dem++;
								if ($dem % 65 == 0) {
									$string .= "<br>";
									$i--;
								}else{
									$string .= $tl->noidung[$i];
								}
								if($tl->noidung[$i] == " "){
									$dem =0;
								}
							}
							echo '<span style="display:block">'.$string.'</span>';
						?>
					@endif
				@endforeach 
				</div>
			</div>

			@if(Auth::check() && $cm->parent_id ==0)
				<div class="col-md-offset-1 col-xs-offset-1 row">
					<a href="#tlbl{{$cm->id}}" class="tlbl" data-toggle ="tab" style="margin-left: 40px;">Tra loi</a>				
					<div id="tlbl{{$cm->id}}" style="display: none;" class="traloi">     
			            <div class="form-group">
			                <textarea class="form-control formtraloi" id="traloi" name="traloi" rows="1" style="float:left; width: 80%"></textarea>
			                <button class="btn btn-success guitraloi" id="guitraloi{{$cm->id}}" style="margin-left: 10px"><i class="fa fa-send-o"></i></button>
			            </div>	            	
					</div>
				</div>
			@endif						
		@endforeach
		</div>
		@if($cttour->comment->count() == 0)
			<span style="color:#A9A9A9; display: block;" id="no-comment">Hien chua co binh luan nao.</span>
		@endif
		
		@if(Auth::check())
			<p><b>Gửi cau hoi hoac nhan xet của bạn về tour</b></p>	
			<div align="center">
				<input type="hidden" name="users_id" id="users_id" value="{{Auth::user()->id}}">
				<input type="hidden" name="tour_id" id="tour_id" value="{{$cttour->id}}">
				<textarea name="noidung" rows="2" class="form-control formbinhluan" style="width: 90%; float: left"></textarea>
				<button type="submit" class="btn btn-success guibinhluan" style="margin-top:10px; font-family: arial;"><i class="fa fa-send-o"></i></button>
			</div>
		@endif		
	</div>
</div>
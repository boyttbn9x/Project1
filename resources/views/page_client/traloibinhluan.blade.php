@extends('master_client')
@section('content')

<div class="col-md-9">
	<div class="panel panel-default">

		<div class="panel-heading" style="background-color:#337AB7; color:white;" >
			<h2 style="margin-top:0px; margin-bottom:0px; text-align: center;"> Tra loi binh luan</h2>
		</div>

		@if(count($errors)>0)
            <div class="alert alert-danger" style="margin-top: 20px; width:50%" >
                @foreach($errors->all() as $err)
                	{{$err}}<br>
                @endforeach()
            </div>
        @endif

		<div class="panel-body">
			<!-- item -->
			<div class="row-item row">
				<div class="col-md-12 border-right">
					<div class="col-md-9">
						<i style="color: red">**Vui lòng nhập câu trả lời cho binh luan: <span style="color: #A9A9A9">{{$bl->noidung}}</span></i><br><br>
				        <form method="post" action="{{route('tra-loi',$bl->id)}}">
				            <input type="hidden" name="_token" value="{{csrf_token()}}" >           
				            <div class="form-group">
				                    <textarea rows="8" cols="90" name="traloi"></textarea>
				            </div>
				            <div align="center">
				            	<button type="submit" class="btn btn-success">Gui</button>
				        	</div>
				        </form>
					</div>
				</div>
				<div class="break"></div>
			</div>
			<!-- end item -->

		</div>
	</div>
</div>

@endsection
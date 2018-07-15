<div class="modal" id="DangKyKhach">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn btn-danger" data-dismiss="modal" style="float: right; padding: 3px 20px; font-weight: bold;">X</button>
            <!-- Modal Header -->
            <div class="modal-header" style="background-color: #66FFFF">  
                <div align="center" style="font-size: 32px; font-weight: bold; color: red">Dang ky Khach du lich</div>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                @if(Session::has('thanhcongkhach'))
                    <div class="alert alert-success text-center">{{Session::get('thanhcongkhach')}}</div>
                @endif

                <form action="{{route('dang-ky-khach')}}" method="POST">
                    <fieldset style="color: blue; font-style: italic;">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <label>Ho ten</label> 
                        <span style="color: red; margin-left: 20px">{{$errors->first('hoten')}}</span>
                        <input class="form-control" name="hoten" type="text" value="{{ old('hoten') }}"><br>

                        <label>Email</label> <span id="msgbox"></span>
                        <span style="color: red; margin-left: 20px">{{$errors->first('email')}}</span>           
                        <input class="form-control" name="email" type="email" value="{{ old('email') }}" id="email">
                        <br>

                        <label>Mat khau</label>
                        <span style="color: red; margin-left: 20px">{{$errors->first('password')}}</span>   
                        <input class="form-control" name="password" type="password"><br>

                        <label>Nhap lai mat khau</label>
                        <span style="color: red; margin-left: 20px">{{$errors->first('passwordAgain')}}</span>   
                        <input class="form-control" name="passwordAgain" type="password"><br>

                        <label>So dien thoai</label>
                        <span style="color: red; margin-left: 20px">{{$errors->first('sodienthoai')}}</span>   
                        <input type="text" name="sodienthoai" class="form-control" value="{{ old('sodienthoai') }}"><br>

                        <div align="center"><button type="submit" class="btn btn-lg btn-success btn-block" id="btnKhach" style="width: 20%">Đăng ký</button></div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="DangKyHDV">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn btn-danger" data-dismiss="modal" style="float: right; padding: 3px 20px; font-weight: bold;">X</button>
            <!-- Modal Header -->
            <div class="modal-header" style="background-color: #66FFFF">  
                <div align="center" style="font-size: 32px; font-weight: bold; color: red">Dang ky Huong dan vien</div>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                @if(Session::has('thanhconghdv'))
                    <div class="alert alert-success text-center">{{Session::get('thanhconghdv')}}</div>
                @endif

                <form action="{{route('dang-ky-hdv')}}" method="POST">
                    <fieldset style="color: blue; font-style: italic;">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <label>Ho ten</label> 
                        <span style="color: red; margin-left: 20px">{{$errors->first('hoten')}}</span>
                        <input class="form-control" name="hoten" type="text" value="{{ old('hoten') }}"><br>

                        <label>Email</label> <span id="msgbox1"></span>
                        <span style="color: red; margin-left: 20px">{{$errors->first('email')}}</span>
                        <input class="form-control" name="email" type="email" value="{{ old('email') }}" id="email1"><br>

                        <label>Mat khau</label>
                        <span style="color: red; margin-left: 20px">{{$errors->first('password')}}</span>
                        <input class="form-control" name="password" type="password"><br>

                        <label>Nhap lai mat khau</label>
                        <span style="color: red; margin-left: 20px">{{$errors->first('passwordAgain')}}</span>
                        <input class="form-control" name="passwordAgain" type="password"><br>

                        <label>So dien thoai</label>
                        <span style="color: red; margin-left: 20px">{{$errors->first('sodienthoai')}}</span>
                        <input type="text" name="sodienthoai" class="form-control" value="{{ old('sodienthoai') }}"><br>

                        <label>Dia chi</label>
                        <span style="color: red; margin-left: 20px">{{$errors->first('diachi')}}</span>
                        <input type="text" name="diachi" class="form-control" value="{{ old('diachi') }}"><br>

                        <div align="center"><button type="submit" class="btn btn-lg btn-success btn-block" id="btnHDV" style="width: 20%">Đăng ký</button></div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="DangNhap">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn btn-danger" data-dismiss="modal" style="float: right; padding: 3px 20px; font-weight: bold;">X</button>
            <!-- Modal Header -->
            <div class="modal-header" style="background-color: #66FFFF">  
                <div align="center" style="font-size: 32px; font-weight: bold; color: red">Dang Nhap</div>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                @if(Session::has('loiLogin'))
                    <div class="alert alert-danger text-center">{{Session::get('loiLogin')}}</div>
                @endif

                <form action="{{route('dang-nhap')}}" method="POST">
                    <fieldset style="color: blue; font-style: italic;">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <label>Email</label>
                        <span style="color: red; margin-left: 20px">{{$errors->first('email')}}</span>
                        <input class="form-control" name="email" type="email" value="{{ old('email') }}"><br>

                        <label>Mat khau</label>
                        <span style="color: red; margin-left: 20px">{{$errors->first('password')}}</span>
                        <input class="form-control" name="password" type="password"><br>

                        <div align="center">
                            <input type="checkbox" name="ghinho" id="chkGhinho"> <label style="font-size: 20px; font-weight: bold;" id="ghinho">Ghi nho dang nhap</label> <br><br>
                            <button type="submit" class="btn btn-lg btn-success btn-block" style="width: 20%">Đăng nhap</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

@if(Auth::check())
    @if(isset($cttour))
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
    		    				@if(session('loiKhachMax'))
    		    					{{Session::get('loiKhachMax')}}
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
@endif

@if(isset($user))
<div class="modal" id="SuaThongTin">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn btn-danger" data-dismiss="modal" style="float: right; padding: 3px 20px; font-weight: bold;">X</button>
            <!-- Modal Header -->
            <div class="modal-header" style="background-color: #66FFFF">  
                <div align="center" style="font-size: 32px; font-weight: bold; color: red">Sua thong tin</div>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
            	@if(Session::has('suathanhcong'))
		            <div class="alert alert-success text-center">{{Session::get('suathanhcong')}}</div>
		        @endif
                <form action="{{route('sua-thong-tin')}}" method="post" enctype="multipart/form-data">
	                <input type="hidden" name="_token" value="{{csrf_token()}}">

	                <label>Họ tên</label>
	                <span style="color: red; margin-left: 20px">{{$errors->first('hoten')}}</span>
	                <input type="text" class="form-control" name="hoten" value="{{$user->hoten}}">
	                <br>

	                <input type="checkbox" name="checkpassword" id="changePassword"><label> Thay doi mat khau</label><br>

	                <label>Mật khẩu moi</label>
	                <span style="color: red; margin-left: 20px">{{$errors->first('password')}}</span>
	                <input type="password" class="form-control password" name="password" disabled="">
	                <br>

	                <label>Xac nhan mat khẩu moi</label>
	                <span style="color: red; margin-left: 20px">{{$errors->first('passwordAgain')}}</span>
	                <input type="password" class="form-control password" name="passwordAgain" disabled="">
	                <br>

	                <label>Anh dai dien</label>
	                @if(Session::has('loianh')) 
	                	<span style="color: red; margin-left: 20px">{{Session::get('loianh')}}</span>
	                @endif
	                <input type="file" class="form-control" name="anhdaidien" value="{{$user->anhdaidien}}">
	                <br>

	                <label>So dien thoai</label>
	                <span style="color: red; margin-left: 20px">{{$errors->first('sodienthoai')}}</span>
	                <input type="text" class="form-control" name="sodienthoai" value="{{$user->sodienthoai}}">
	                <br>

	                <label>Dia chi</label>
	                <input type="text" class="form-control" name="diachi" value="{{$user->diachi}}">
	                <br>

	                <label>Nam sinh</label>
	                @if(Session::has('loinamsinh')) 
	                	<span style="color: red; margin-left: 20px">{{Session::get('loinamsinh')}}</span>
	                @endif
	                <input type="text" class="form-control" name="namsinh" value="{{$user->namsinh}}">
	                <br>

	                <label>Gioi tinh:</label>                                
	                @if($user->gioitinh == 'Nam')
					<input type="radio" name="gioitinh" value="Nam" style="margin-left: 80px" checked=""> Nam
					<input type="radio" name="gioitinh" value="Nu" style="margin-left: 80px"> Nu
					@elseif($user->gioitinh == 'Nu')
					<input type="radio" name="gioitinh" value="Nam" style="margin-left: 80px"> Nam
					<input type="radio" name="gioitinh" value="Nu" style="margin-left: 80px" checked=""> Nu
					@else
					<input type="radio" name="gioitinh" value="Nam" style="margin-left: 80px"> Nam
					<input type="radio" name="gioitinh" value="Nu" style="margin-left: 80px"> Nu
					@endif
	                <br>

	                <div align="center">
	                    <button type="submit" class="btn btn-success">Sua</button>
	                </div>
	            </form>
            </div>
        </div>
    </div>
</div>
@endif



@if(count($errors)>0)
    @if(Session::has('loiDangKyKhach'))
    <script>
        $(document).ready(function(){
            $("#DangKyKhach").modal();
        });
    </script>
    @elseif(Session::has('loiDangKyHDV'))
    <script>
        $(document).ready(function(){
            $("#DangKyHDV").modal();
        });
    </script>
    @elseif(Session::has('loiDangNhap'))
    <script>
        $(document).ready(function(){
            $("#DangNhap").modal();
        });
    </script>
    @elseif(Session::has('errorDatTour'))
    <script>
        $(document).ready(function(){
            $("#DatTour").modal();
        });
    </script>
    @endif
@endif

@if(session('loiKhachMax'))
    <script>
        $(document).ready(function(){
            $("#DatTour").modal();
        });
    </script>
@endif
@if(session('successDatTour'))
    <script type="text/javascript">
        alert('Dat tour thanh cong.');
    </script>
@endif

@if(Session::has('loiLogin'))
    <script>
        $(document).ready(function(){
            $("#DangNhap").modal();
        });
    </script>
@elseif(Session::has('thanhcongkhach'))
    <script>
        $(document).ready(function(){
            $("#DangKyKhach").modal();
        });
    </script>
@elseif(Session::has('thanhconghdv'))
    <script>
        $(document).ready(function(){
            $("#DangKyHDV").modal();
        });
    </script>
@endif

@if(count($errors)>0 || Session::has('suathanhcong') || Session::has('loianh') || Session::has('loinamsinh'))
    <script type="text/javascript">
        $(document).ready(function(){
            $("#SuaThongTin").modal();
        });
    </script>
@endif

@if(Session::has('loiTimkiem'))
    <script>
        alert('Vui long nhap thong tin can tim kiem.')
    </script>
@endif

@if(Session::has('successRate'))
    <script type="text/javascript">
        $(document).ready(function(){
            $('#danhgia').show();
        });
    </script>
@endif  


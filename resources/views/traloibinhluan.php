<?php
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$noidung =  $_POST['noidung'];
	$parent_id = $_POST['parent_id'];
	$tour_id =  $_POST['tour_id'];
	$users_id = $_POST['users_id'];
	$messages = "";
	$id = 0;

	if(!empty($noidung)){
		$link = mysqli_connect("localhost", "root", "") or die("Không thể kết nối được MySQL Database");
		$link->set_charset('utf8');
		mysqli_select_db($link,"tour");
		$created_at = date('Y-m-d H:m:i');

		$sql = "insert into comment(tour_id,parent_id,users_id,noidung,created_at) values('".$tour_id."','".$parent_id."','".$users_id."','".$noidung."','".$created_at."')";

		mysqli_query($link,$sql);
		if ($parent_id == 0) {
			$id = mysqli_insert_id($link);
		}

		$sql = "select email from users where id = ".$users_id;
		$result = mysqli_query($link,$sql);
		$email ="";
		while ($value = mysqli_fetch_array($result)) {
			$email = $value[0];
		}

		$string ="";
		$dem = 0;
		for($i=0; $i < strlen($noidung); $i++){
			$dem++;
			if ($dem % 65 == 0) {
				$string .= "<br>";
				$i--;
			}else{
				$string .= $noidung[$i];
			}
			if($noidung[$i] == " "){
				$dem =0;
			}
		}
		if ($parent_id != 0) {
			$messages = '<a><i class="fa fa-user"></i>'.$email.'</a>'.'<a style="margin-left: 5px"><i class="fa fa-clock-o"></i>'.$created_at.'</a>'.'<span style="display:block">'.$string.'</span>';
		}else{
			$messages = '
				<div id="dstraloi'.$id.'">
					<div class="col-md-11 col-xs-11 col-md-offset-1 col-xs-offset-1">
					</div>
				</div>
				<div style="margin-left: 50px">
					<a><i class="fa fa-user"></i>'.$email.'</a>
					<a style="margin-left: 5px"><i class="fa fa-clock-o"></i>'.$created_at.'</a>
					<br>'.$string.'
				</div>
				<div class="col-md-offset-1 col-xs-offset-1 row">
					<a href="#tlbl'.$id.'" class="tlbl" data-toggle ="tab" style="margin-left: 40px;">Tra loi</a>
					<div id="tlbl'.$id.'" style="display: none;" class="traloi"> 
			            <div class="form-group">
			                <textarea class="form-control formtraloi" id="traloi" name="traloi" rows="1" style="float:left; width: 80%"></textarea>
			                <button class="btn btn-success guitraloi" id="guitraloi'.$id.'" style="margin-left: 10px"><i class="fa fa-send-o"></i></button>
			            </div>	            	
					</div>
				</div>';
		}

	}else{
		$messages = "Vui long nhap noi dung tra loi";
	}
	$response = array("messages"=>$messages);
	$jsonString = json_encode($response);
	echo $jsonString;
?>

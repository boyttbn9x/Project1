<?php
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$noidung =  $_POST['noidung'];
	$parent_id = $_POST['parent_id'];
	$tour_id =  $_POST['tour_id'];
	$users_id = $_POST['users_id'];
	$messages = "";

	if(!empty($noidung)){
		$link = mysqli_connect("localhost", "root", "") or die("Không thể kết nối được MySQL Database");
		$link->set_charset('utf8');
		mysqli_select_db($link,"tour");
		$created_at = date('Y-m-d H:m:i');

		$sql = "insert into comment(tour_id,parent_id,users_id,noidung,created_at) values('".$tour_id."','".$parent_id."','".$users_id."','".$noidung."','".$created_at."')";
		mysqli_query($link,$sql);

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
			$messages = '<div class="col-md-11 col-xs-11 col-md-offset-1 col-xs-offset-1"><a><i class="fa fa-user"></i>'.$email.'</a>'.'<a style="margin-left: 5px"><i class="fa fa-clock-o"></i>'.$created_at.'</a><br>'.$string.'</div>';
		}else{
			$messages = '<div style="margin-left: 50px"><a><i class="fa fa-user"></i>'.$email.'</a>'.'<a style="margin-left: 5px"><i class="fa fa-clock-o"></i>'.$created_at.'</a><br>'.$string.'</div>';
		}	

	}else{
		$messages = "Vui long nhap noi dung tra loi";
	}
	$response = array("messages"=>$messages);
	$jsonString = json_encode($response);
	echo $jsonString;
?>

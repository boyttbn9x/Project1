<?php
	$timkiem = $_POST["search"];
	if(!empty($timkiem)){
		$link = mysqli_connect("localhost", "root", "") or die("Không thể kết nối được MySQL Database");
		$link->set_charset('utf8');
		mysqli_select_db($link,"tour");

		$sql = "SELECT * FROM tour WHERE tentour LIKE '%".$timkiem."%'";
		$result = mysqli_query($link,$sql);
		$value = array();
		$flag = false;
		if($result && mysqli_num_rows($result)>0){	
			$i =0;
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$value[$i][0] = $row['id'];
				$value[$i][1] = $row['tentour'];
				$value[$i][2] = $row['giatour'];
				$i++;
			}
			$flag = true;
		}
		$response = array("flag"=> $flag, "ketqua" => $value);
		echo json_encode($response);
	}
?>
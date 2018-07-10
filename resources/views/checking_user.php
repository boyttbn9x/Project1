<?php
	$email = $_POST["email"];
	if(!empty($email)){
		$link = mysqli_connect("localhost", "root", "") or die("Không thể kết nối được MySQL Database");
		$link->set_charset('utf8');
		mysqli_select_db($link,"tour");

		$sql = "select * from users where email = '".$email."'";
		$result = mysqli_query($link,$sql);
		$dong = mysqli_num_rows($result);
		if($dong){
			echo "no";
		}elseif(! (strstr($email,"@gmail.com") || strstr($email,"@yahoo.com"))){
			echo "no";
		}else{ 
			$array = explode('@', $email);
			if (isset($array[2])) {
				echo "no";
			}elseif (isset($array[1]) && ($array[1] == 'gmail.com' || $array[1] == 'yahoo.com')) {
				echo "yes";
			}else{
				echo "no";
			}			
		}
	}else{
		echo "no";
	}
?>
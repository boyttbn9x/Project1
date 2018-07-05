$(document).ready(function(){
	$("#email").blur(function(){
		$("#msgbox").removeClass().addClass("msgboxcheck").html(' <i class="glyphicon glyphicon-repeat" style="margin-top:9px; margin-left:7px"></i>').fadeIn("slow");
		$.post("../resources/views/checking_user.php",{email:$(this).val()}, function(data){
			if(data == "yes"){
				$("#msgbox").fadeTo(200,0.1,function(){
					$(this).addClass('msgboxok').html(' <i class = "glyphicon glyphicon-ok-sign" style="color:green; margin-top:9px; margin-left:7px"></i>').fadeTo(100,1)
				})
			}
			if(data == "no"){
				$("#msgbox").fadeTo(200,0.1,function(){
					$(this).addClass('msgboxerror').html(' <i class = "glyphicon glyphicon-remove-sign" style="color:red; margin-top:9px; margin-left:7px"></i>').fadeTo(100,1)
				})
			}
		})
	})
})

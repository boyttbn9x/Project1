<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title>Tour</title>
    <base href="{{asset('')}}">
    
    <!-- Bootstrap Core CSS -->
    <link href="dulich/css/bootstrap.min.css" rel="stylesheet">

    <script src="dulich/js/jquery.js"></script>
    <script src="dulich/js/bootstrap.min.js"></script>
    
    <script type="text/javascript">
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

        $("#email1").blur(function(){
            $("#msgbox1").removeClass().addClass("msgboxcheck").html(' <i class="glyphicon glyphicon-repeat" style="margin-top:9px; margin-left:7px"></i>').fadeIn("slow");
            $.post("../resources/views/checking_user.php",{email:$(this).val()}, function(data){
                if(data == "yes"){
                    $("#msgbox1").fadeTo(200,0.1,function(){
                        $(this).addClass('msgboxok').html(' <i class = "glyphicon glyphicon-ok-sign" style="color:green; margin-top:9px; margin-left:7px"></i>').fadeTo(100,1)
                    })
                }
                if(data == "no"){
                    $("#msgbox1").fadeTo(200,0.1,function(){
                        $(this).addClass('msgboxerror').html(' <i class = "glyphicon glyphicon-remove-sign" style="color:red; margin-top:9px; margin-left:7px"></i>').fadeTo(100,1)
                    })
                }
            })
        })
    })
    </script>

    <style type="text/css">
        .slide-image {
            width: 100%;
        }
        .glyphicon-star{
            font-size: 25px;
        }  
        .glyphicon-star-empty{
            font-size: 25px;
        }      
</style>

</head><!--/head-->

<body>
	@include('header_client')

    <div class="container">
        @include('slide_client')
        <div style="width: 100%; height: 30px"></div>
        @include('menu')
        @yield('content')    
    </div>


    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script type="text/javascript">
        $(document).ready(function(){
            $("#changePassword").change(function(){
                if($(this).is(":checked")){
                    $(".password").removeAttr('disabled');
                }else{
                    $(".password").attr('disabled','');
                }
            });

            $(".menu1").next('ul').toggle();

            $(".menu1").click(function(event) {
                $(this).next('ul').toggle(500);
            });
        });
    </script>
</body>
</html>
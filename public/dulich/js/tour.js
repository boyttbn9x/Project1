$(document).ready(function(){
    $("#email").keyup(function(){         
        $.post("../resources/views/checking_user.php",{email:$(this).val()}, function(data){
            if(data == "yes"){
                $("#msgbox").addClass('msgboxok').html(' <i class = "glyphicon glyphicon-ok-sign" style="color:green; margin-left:7px"></i>');
                $("#btnKhach").removeAttr("disabled");
            }
            if(data == "no"){
                $("#msgbox").addClass('msgboxerror').html(' <i class = "glyphicon glyphicon-remove-sign" style="color:red; margin-left:7px"></i>');
                $("#btnKhach").attr("disabled","");
            }
        });
    });

    $("#email1").keyup(function(){
        $.post("../resources/views/checking_user.php",{email:$(this).val()}, function(data){
            if(data == "yes"){
                $("#msgbox1").addClass('msgboxok').html(' <i class = "glyphicon glyphicon-ok-sign" style="color:green; margin-left:7px"></i>');
                $("#btnHDV").removeAttr("disabled");
            }
            if(data == "no"){
                $("#msgbox1").addClass('msgboxerror').html(' <i class = "glyphicon glyphicon-remove-sign" style="color:red; margin-left:7px"></i>');
                $("#btnHDV").attr("disabled","");
            }
        });
    });

    $('.tlbl').click(function(){
        traloi = $(this).attr('href');
        $('.traloi').slideUp();
        $(traloi).slideToggle();
    })
    $('#bl').click(function(){
        $('#danhgia').hide();
        $('#reviews').show();
    })
    $('#dg').click(function(){
        $('#reviews').hide();
        $('#danhgia').show();      
    })

    $('.glyphicon-star').click(function(){
        danhgia = $(this).attr('id');
        for(var i = 1; i <= 5; i++){
            dg = '#dg' + i;
            if(i <= danhgia[2]){        
                $(dg).css('color','yellow');
            }else{
                $(dg).css('color','#DDDDDD');
            }
        }
        $('#sodiemdanhgia').val(danhgia[2]);
    });

    $("#changePassword").change(function(){
        if($(this).is(":checked")){
            $(".password").removeAttr('disabled');
        }else{
            $(".password").attr('disabled','');
        }
    });

    $(".menu1").next('ul').toggle();
    $(".menu1").mouseover(function(event) {
        $(this).next('ul').show(500);
    });
})
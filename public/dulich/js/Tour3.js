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

    $(".menu1").mouseover(function(event) {
        $(this).next('ul').show(500);
    });

    $('.menu1').next('ul').mouseover(function(){
        $(this).show();
    });

    $('.menu1').next('ul').mouseout(function(){
        $(this).hide();
    });

    $(".menu1").mouseout(function(){  
        $(this).next('ul').hide();      
    });

    $('#timkiem').keyup(function(){
        var timkiem = $(this).val();
        if(timkiem.length >3){
            $('#divtimkiem').show();
            $('#dsketqua li').remove();
            $.ajax({
                url: "../resources/views/timkiem.php",
                method: "post",
                data: {search:timkiem},
                dataType: "text",
                success: function(data){
                    var ketqua = JSON.parse(data);
                    console.log(ketqua);
                    console.log(ketqua.ketqua[0][1]);
                    for (var i = 0; i < ketqua.ketqua.length; i++) {
                        console.log('1');
                        stringds = '<li style="padding: 5px"><a href = "chi-tiet/'+ ketqua.ketqua[i][0] +'">' + ketqua.ketqua[i][1] +'</a><br><span>'+ ketqua.ketqua[i][2]+' vnd</span></li>';
                        $('#dsketqua').append(stringds);
                    }
                }
            });
        }else{
            $('#divtimkiem').hide();
        }
    });
 
    $('.tlbl').click(function(){
        traloi = $(this).attr('href');
        var flag = true;
        if($(traloi).css('display') == 'block'){
            flag = false;
        }
        $('.traloi').slideUp();
        if(flag == true){
            $(traloi).slideToggle();
        }
        $('.formtraloi').val('');
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

    $('.formtraloi').keyup(function(){
        var traloi = $(this).val();
        var dem = 1;
        $(this).attr('rows',dem);
        var demkytu = 0;
        for (var i = 0; i < traloi.length; i++) {
            demkytu++;
            if(traloi[i] == "\n"){
                dem++;
                $(this).attr('rows',dem);
                demkytu = 0;
            }
            if(demkytu == 74){
                dem++;
                $(this).attr('rows',dem);
                demkytu = 0;
            }
        }          
    });

    $('.guitraloi').click(function(){
        var idbl = $(this).attr('id');
        idbl = idbl.substring(9,idbl.length);
        noidung = $('#tlbl'+idbl+' #traloi').val();
        noidung = noidung.replace(/\n/g, "<br>")

        tour_id = $('#tour_id').val();
        users_id = $('#users_id').val();
        $.post("../resources/views/traloibinhluan.php",{noidung: noidung, parent_id:idbl, tour_id:tour_id, users_id:users_id}, function(data){              
                if (data.messages == "Vui long nhap noi dung tra loi") {
                    alert(data.messages);
                }else{
                    $('#dstraloi'+idbl+' div').append(data.messages);                     
                }
        },'json');
        $('#tlbl'+idbl+' #traloi').val('').attr('rows',1);
    });
    
    $('.formbinhluan').keyup(function(){
        var traloi = $(this).val();
        var dem = 2;
        $(this).attr('rows',dem);
        var demkytu = 0;
        for (var i = 0; i < traloi.length; i++) {
            if(traloi[i] == "i" || traloi[i] == "j" || traloi[i] == "l" ){
                demkytu += 85/213;
            }else if(traloi[i] == "w" || traloi == "H" || traloi == "D" || traloi[i] == 'U'){
                demkytu += 85/65;
            }else if(traloi[i] == "." || traloi[i] == "," || traloi[i] == "t" || traloi[i] == ":" || traloi[i] == '/' || traloi[i] == "\\" || traloi[i] == "[" || traloi[i] == "]" || traloi[i] == 'I'){
                demkytu += 85/170;
            }else if(traloi[i] == "m" || traloi[i] == "M"){
                demkytu += 85/56;
            }else if(traloi[i] == "f" || traloi[i] == "|"){
                demkytu += 85/182;
            }else if(traloi[i] == "r"){
                demkytu += 85/142;
            }else if(traloi[i] == "y" || traloi[i] == "k" || traloi[i] == "J"){
                demkytu += 85/94;
            }else if(traloi[i] == '"'){
                demkytu += 85/133;
            }else if(traloi[i] == "<" || traloi[i] == ">" ){
                demkytu += 85/81;
            }else if(traloi[i] == "{" || traloi[i] == "}" ){
                demkytu += 85/141;
            }else if(traloi[i] == "1" || traloi[i] == "}" ){
                demkytu += 85/98;
            }else if(traloi[i] == 'W'){
                demkytu += 85/50;
            }else if(traloi[i] == 'G'){
                demkytu += 85/60;
            }else if(traloi[i]>='A' || traloi[i]<='Z'){
                demkytu += 85/70;
            }else{
                demkytu++;
            }

            if(traloi[i] == "\n"){
                dem++;
                $(this).attr('rows',dem);
                demkytu = 0;
            }
            if(demkytu > 85.3){
                dem++;
                $(this).attr('rows',dem);
                demkytu = 0;
            }
        }          
    });

    $('.guibinhluan').click(function(){
        noidung = $('.formbinhluan').val();
        noidung = noidung.replace(/\n/g, "<br>")

        tour_id = $('#tour_id').val();
        users_id = $('#users_id').val();
        $.post("../resources/views/traloibinhluan.php",{noidung: noidung, parent_id:0, tour_id:tour_id, users_id:users_id}, function(data){              
                if (data.messages == "Vui long nhap noi dung tra loi") {
                    alert('Vui long nhap noi dung binh luan');
                }else{
                    $('.dsbinhluan').append(data.messages);                  
                }
        },'json');
        $('#no-comment').hide();
        $('.formbinhluan').val('').attr('rows',2);
    });

})
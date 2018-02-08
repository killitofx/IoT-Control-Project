/**
 * Created by 14564 on 2017/8/30.
 */
//$(document).ready(function(){
//    $("#btn").on("click",function(){
//        $.get("sever.php",{p2:$("#p2").val()},function(data){
//            $("#result").text(data);
//        });
//    });
//});

$(document).ready(function(){
    $("#p2o").click(function(){
        $.get("api.php",{p2:"1",c:"p2"},function(data){
            $("#result2").text(data);
        });
    });
    $("#p2c").click(function(){
        $.get("api.php",{p2:"0",c:"p2"},function(data){
            $("#result2").text(data);
        });
    });


    $("#p3o").click(function(){
        $.get("sever.php",{p3:"1",c:"p3"},function(data){
            $("#result3").text(data);
        });
    });
    $("#p3c").click(function(){
        $.get("sever.php",{p3:"0",c:"p3"},function(data){
            $("#result3").text(data);
        });
    });


    $("#p4o").click(function(){
        $.get("sever.php",{p4:"1",c:"p4"},function(data){
            $("#result4").text(data);
        });
    });
    $("#p4c").click(function(){
        $.get("sever.php",{p4:"0",c:"p4"},function(data){
            $("#result4").text(data);
        });
    });


    $("#p5o").click(function(){
        $.get("sever.php",{p5:"1",c:"p5"},function(data){
            $("#result5").text(data);
        });
    });
    $("#p5c").click(function(){
        $.get("sever.php",{p5:"0",c:"p5"},function(data){
            $("#result5").text(data);
        });
    });


    $("#p6o").click(function(){
        $.get("sever.php",{p6:"1",c:"p6"},function(data){
            $("#result6").text(data);
        });
    });
    $("#p6c").click(function(){
        $.get("sever.php",{p6:"0",c:"p6"},function(data){
            $("#result6").text(data);
        });
    });



    $("#p7o").click(function(){
        $.get("sever.php",{p7:"1",c:"p7"},function(data){
            $("#result7").text(data);
        });
    });
    $("#p7c").click(function(){
        $.get("sever.php",{p7:"0",c:"p7"},function(data){
            $("#result7").text(data);
        });
    });


    $("#p8o").click(function(){
        $.get("sever.php",{p8:"1",c:"p8"},function(data){
            $("#result8").text(data);
        });
    });
    $("#p8c").click(function(){
        $.get("sever.php",{p8:"0",c:"p8"},function(data){
            $("#result8").text(data);
        });
    });


    $("#p9o").click(function(){
        $.get("sever.php",{p9:"1",c:"p9"},function(data){
            $("#result9").text(data);
        });
    });
    $("#p9c").click(function(){
        $.get("sever.php",{p9:"0",c:"p9"},function(data){
            $("#result9").text(data);
        });
    });


    $("#p10o").click(function(){
        $.get("sever.php",{p10:"1",c:"p10"},function(data){
            $("#result10").text(data);
        });
    });
    $("#p10c").click(function(){
        $.get("sever.php",{p10:"0",c:"p10"},function(data){
            $("#result10").text(data);
        });
    });


    $("#p11o").click(function(){
        $.get("sever.php",{p11:"1",c:"p11"},function(data){
            $("#result11").text(data);
        });
    });
    $("#p11c").click(function(){
        $.get("sever.php",{p11:"0",c:"p11"},function(data){
            $("#result11").text(data);
        });
    });


    $("#p12o").click(function(){
        $.get("sever.php",{p12:"1",c:"p12"},function(data){
            $("#result12").text(data);
        });
    });
    $("#p12c").click(function(){
        $.get("sever.php",{p12:"0",c:"p12"},function(data){
            $("#result12").text(data);
        });
    });


    $("#p13o").click(function(){
        $.get("sever.php",{p13:"1",c:"p13"},function(data){
            $("#result13").text(data);
        });
    });
    $("#p13c").click(function(){
        $.get("sever.php",{p13:"0",c:"p13"},function(data){
            $("#result13").text(data);
        });
    });
});
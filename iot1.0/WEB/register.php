<?php
/**
 * Created by PhpStorm.
 * User: 14564
 * Date: 2017/10/24
 * Time: 9:04
 */
$myUri=$_SERVER['PHP_SELF'];
//if ($_SESSION['id']){echo 'hello';}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>register</title>
    <link rel="stylesheet" type="text/css" href="css/main-style.css">
    <script src = "function/jquery-3.2.1.min.js"></script>

    <style>
        body{
            background-image: url(img/bg.png);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position:center 0;
            background-size:100%;

        }

        input:required{
            background-color:white;
        }
        .invalid input:invalid{
            border: 2px solid blue;
        }
    </style>
</head>
<body>

<div class="topbar">
    <div class="topbody">
        <a class="title" href="index.php">主站</a>
        <ul class="toplist">
            <li><a href="">项目1</a></li>
            <li><a href="">项目2</a></li>
            <li><a href="">项目3</a></li>
            <li><a href="">项目4</a></li>
            <li><a href="">项目5</a></li>
            <li><a href="">项目6</a></li>
            <li><a href="">项目7</a></li>
            <li><a href="login.html">请登录</a></li>
        </ul>
    </div>
</div>


<div class="zhuce">
    <center>
        <a1 style="text-decoration: line-through">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a1>
        <a2 style="font-size: 30px;">注册</a2>
        <a3 style="text-decoration: line-through">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a3>
    </center>
</div>


<div class="signin">
    <center>

            <table width="450" border="0">
                <tr>
                    <td width="100" height="30"><div align="center">昵称</div></td>
                    <td width="185"><input type="text" name="uid" id="uid"onfocus="this.value=''" value='昵称（例bilibili）'></td>
                </tr>
                <tr>
                    <td height="30"><div align="center">密码</div></td>
                    <td><input type="text" name="pw" id="pwd"onfocus="this.value=''" onblur="this.type='password'" onmouseenter="this.type='text'" onmouseleave="this.type='password'"value='密码(6-16个字符组成)'><span id="pwd_result"></td>
                </tr>

                <tr>
                    <td height="30"><div align="center">手机</div></td>
                    <td><input type="text" name="phone" id="phone"onfocus="this.value=''" value='填写常用手机号'><span id="phone_result"></span></td>
                </tr>
                <tr>
                    <td height="30"><div align="center">邮箱</div></td>
                    <td><input type="email"pattern= '^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$' title='请输入正确的邮箱'name="mail" id="mail"onfocus="this.value=''" value='填写常用邮箱'></td>
                </tr>
                <tr>
                    <td height="40" colspan="2"><center><input type="submit" value="提交" id="btn"></center></td>
                </tr>
            </table>

        <span hidden id="name_result"><a href="index.php">注册成功，点此跳转</a></span>

    </center>
</div>


<!--<input type="text" id='uid1' value='pelli'>-->

<script>
//    $(document).ready(function(){
//        $("#pw").click(function(){
//            var name = $("#vname").val();
//            console.log(name);
//            $.get("register.php",{vmane:name,c:"p2"},function(data){
//                $("#name_result").text(data);
//            });
//        });
//        $("#p2c").click(function(){
//            $.get("sever.php",{p2:"0",c:"p2"},function(data){
//                $("#result2").text(data);
//            });
//        });
//    });

$(document).ready(function(e) {
//    $("#name_result").val();
    $("#pwd").blur(function(){//给按钮加点击事件

        //取用户名和密码
        var pwd = $("#pwd").val();//取输入的用户名
//        var p = $("#pwd").val();//取输入的密码
//        window.alert(u);

        //调ajax
        $.ajax({
            url:"admin.php",
            data:{pwd:pwd},//第二个u和p只是变量，可以随意写，dengluchuli.php里面的u和p都是第一个。
            type:"POST",
            dataType:"TEXT",
            success: function(data){
                $("#pwd_result").text(data);
            }

        });

    });

    $("#phone").blur(function(){//给按钮加点击事件

        //取用户名和密码
        var phone = $("#phone").val();//取输入的用户名

//        var p = $("#pwd").val();//取输入的密码
//        window.alert(u);

        //调ajax
        $.ajax({
            url:"admin.php",
            data:{phone:phone},//第二个u和p只是变量，可以随意写，dengluchuli.php里面的u和p都是第一个。
            type:"POST",
            dataType:"TEXT",
            success: function(data){
                $("#phone_result").text(data);
            }

        });

    });



    $("#btn").click(function(){//给按钮加点击事件

        //取用户名和密码
        var uid = $("#uid").val();//取输入的用户名
        var pwd = $("#pwd").val();//取输入的密码
        var tel=$("#phone").val();
        var mail=$("#mail").val();
//        window.alert(u);

        //调ajax
        $.ajax({
            url:"admin.php",
            data:{uid:uid,pwd:pwd,phone:tel,email:mail},//第二个u和p只是变量，可以随意写，dengluchuli.php里面的u和p都是第一个。
            type:"POST",
            dataType:"TEXT",
            success: function(data){
//                $("#name_result").text(data);

                if(data)//要加上去空格，防止内容里面有空格引起错误。
                {
                    $("#name_result").show(1000);
               }
//                else
//                {
//                    echo("用户名或密码错误");
//                }

            }

        });

    })
});

</script>



</body>
</html>


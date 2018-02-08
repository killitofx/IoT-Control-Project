<?php
$arr=array();
session_start();
error_reporting(E_ALL || ~E_NOTICE);
if (isset($_SESSION['id'])) {
    $id=$_SESSION['id'];
    require_once 'function/functions.php';
    $conn = connectDb();
    if (!$conn) {
        //echo '连接失败';
    }
    // echo '连接成功';
    mysqli_query($conn , "set names utf8");
    $sql = "SELECT user_id,device_id,device_name
        FROM device
        WHERE user_id='$id';";

    mysqli_select_db($conn, 'RASPI');
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die('无法更新数据: ' . mysqli_error($conn));
    }
    //echo '数据读取成功！';
    //echo '<br>';

    while ($row = mysqli_fetch_array($retval, MYSQL_ASSOC)) {
        $arr_id[]=  $row['device_id'];
        $arr_name[]=$row['device_name'];

    }
    mysqli_free_result($retval);
    mysqli_close($conn);
//    print_r($arr);
//    echo count($arr);
    $block_num=count($arr_id);
    $admin=1;
}
else{
    $admin=0;
}
?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>index</title>
    <style>
        body{
            background-image:url("http://videobilibili.oss-cn-shanghai.aliyuncs.com/photo/indexbg.png");
            background-repeat: no-repeat;
        }
        .index{
            margin-top: 150px;
        }
        #noadmin{
            font-size: 50px;
            margin-top: 280px;
            margin-left: 350px;
            /*text-align: center;*/
        }

    </style>
    <link rel="stylesheet" type="text/css" href="css/main-style.css">
    <link rel="stylesheet" type="text/css" href="css/index_content.css">
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
            <!--        </ul>-->
            <!--    </div>-->
            <!--</div>-->
            <?php

            error_reporting(E_ALL || ~E_NOTICE);
            //require_once 'functions.php';
            //$conn = connectDb();

            session_start();
            if($_SESSION['vname']!='')
            {
                echo'<li><a>'.$_SESSION['vname'];
                echo'</a></li>';
                echo'<li><a href="logout.php">登出</a></li><br>';
            }
            else
            {
                echo'<li><a href="login.html">请登录</a></li><br>';
            }
            echo "</ul></div></div>";
            ?>

            <div id="state">
                <?php

                if ($admin) {
                    echo "<div class=box1>";
                    echo "<div class=block>
            <a href = adev/index.php><img src=img/console-icon.png height=80 width=80><div class=href>add device</div></a>
        </div>";
                    if ($block_num) {
                        for ($i = 0; $i < $block_num; $i++) {
                            echo "<div class=block>
            <a href = detail.php?dev_id=$arr_id[$i]&dev_name=$arr_name[$i]><img src=img/console-icon.png height=80 width=80><div class=href>$arr_name[$i]</div></a>
        </div>";
                        }
                        echo "</div>";
                    }
                }

                else{
                    echo "<p id='noadmin'>欢迎使用IoT物联网框架<br></p>";
                }
                ?>

                <!--    <div class="box1">-->
                <!--        <div class="block">-->
                <!--            <a href = "https://baidu.com"><img src="png/baidu-icon1.png" height="80" width="80"><div class="href">百度</div></a>-->
                <!--        </div>-->
                <!---->
                <!--        <div class="block">-->
                <!--            <a href = "http://bilibili.com"><img src="png/bilibili-icon.png" height="80" width="80"><div class="href">哔哩哔哩</div></a>-->
                <!--        </div>-->
                <!---->
                <!--        <div class="block">-->
                <!--            <a href = "https://taobao.com"><img src="png/taobao-icon.png" height="80" width="80"><div class="href">淘宝</div></a>-->
                <!--        </div>-->
                <!---->
                <!--        <div class="block">-->
                <!--            <a href = "http://www.kisssub.org/"><img src="png/torrent-icon.png" height="80" width="80"><div class="href">极影</div></a>-->
                <!--        </div>-->
                <!---->
                <!--        <div class="block">-->
                <!--            <a href = "https://www.aliyun.com/"><img src="png/aliyun-icon.png" height="80" width="80"><div class="href">阿里云控制台</div></a>-->
                <!--        </div>-->
                <!---->
                <!---->
                <!--    </div>-->
                <!--    </div>-->


</body>
</html>


<?php
/**
 * Created by PhpStorm.
 * User: 14564
 * Date: 2017/10/25
 * Time: 14:57
 */
session_start();
error_reporting(E_ALL || ~E_NOTICE);
$dbname = "raspi";
require_once '../function/config.php';
$dev_id=$_SESSION['del_dev_id'];
$dev_name=$_SESSION['del_dev_name'];

if(isset($_SESSION["id"]))
{
    if (isset($_POST['del']))
    {
    echo"开启删除模式<br>";
        $del=1;
    }
    elseif(isset($_POST['nodel'])){
        echo"未删除";
        $del=0;
        unset($_SESSION['del_dev_id']);
        unset($_SESSION['del_dev_name']);
        echo"<script>alert('返回中。。。');history.go(-2);</script>";
//        header("Location: ../index.php");

    }
    else{
        echo"参数错误";
        $del=0;
    }
}
else{
    echo"<a href=../login.php>请登陆</a>";
}

if ($del){
    $conn = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PW, $dbname);
// 检查链接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }

    $sql="DELETE FROM device WHERE device_id='$dev_id'";
//    mysqli_query($con,$sql);
    if ($conn->multi_query($sql) === TRUE) {
        echo "设备删除成功<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql="DELETE FROM state WHERE device_id='$dev_id'";
//    mysqli_query($con,$sql);
    if ($conn->multi_query($sql) === TRUE) {
        echo "端口删除成功<br><br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    echo"<a href=../index.php>点击返回首页</a>";
    unset($_SESSION['del_dev_id']);
    unset($_SESSION['del_dev_name']);
}


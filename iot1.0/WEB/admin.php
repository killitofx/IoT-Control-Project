<?php
/**
 * Created by PhpStorm.
 * User: 14564
 * Date: 2017/10/24
 * Time: 10:00
 */
error_reporting(E_ALL || ~E_NOTICE);
//echo $_POST['uid'];
session_start();
require_once 'function/functions.php';
$conn = connectDb();
if (!$conn)
{
    echo '不好意思数据库好像失联了';
    $_SESSION['next']=0;
}else {

    if (isset($_POST['pwd']) && !isset($_POST['phone'])) {
        if(isset($_POST['pwd']{5})){
//            $method = 1;
            echo "成功";
        }
        else{
            echo "密码位数请大于6";
            $_SESSION["next"]=0;
        }

    } elseif (isset($_POST['phone'])&& !isset($_POST['uid'])) {
        if (strlen(floor($_POST['phone']))==11){
//            echo strlen(floor($_POST['phone']));
            $method = 2;

        }
        else{echo "输入11位电话";$_SESSION["next"]=0;}

    } elseif(isset($_POST['uid']) && isset($_POST['pwd']) && isset($_POST['phone']) && isset($_POST['email'])) {
        if (isset($_POST['pwd']{5})){
        $method = 3;
    }
        else{
            echo "密码位数大于6";
            $_SESSION["next"]=0;
        }}
    else{
        $method=0;
        $_SESSION['next']=0;
        echo'参数错误';
//        echo $email.$uid.$phone.$pwd;
    }
}

//验证账号
//if ($method == 1) {
//    $uid = $_POST['uid'];
//
//
//    mysqli_query($conn, "set names utf8");
//
//    $sql = "SELECT vname,pw,mail,phone,id
//                FROM users
//                WHERE vname=$uid";
//
//    mysqli_select_db($conn, 'RASPI');
//    $retval = mysqli_query($conn, $sql);
//    if (!$retval) {
//        die('您的机体好像不认识您，他拒绝了您的访问: ' . mysqli_error($conn));
////        echo "账号已存在";
//    }
//    while ($row = mysqli_fetch_array($retval, MYSQL_ASSOC)) {
//        $vname = $row['vname'];
//    }
//    if ($vname){
//        echo '账号已存在';
//    }
//    else{
//        echo "成功";
//    }
//
//    mysqli_close($conn);
//}

//验证电话
if ($method == 2 && strlen(floor($_POST['phone']))==11) {
    $phone = $_POST['phone'];


    mysqli_query($conn, "set names utf8");

    $sql = "SELECT vname,pw,mail,phone,id
                FROM users
                WHERE phone=$phone";

    mysqli_select_db($conn, 'RASPI');
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
//        die('您的机体好像不认识您，他拒绝了您的访问: ' . mysqli_error($conn));
        echo "lost link";
    }
    while ($row = mysqli_fetch_array($retval, MYSQL_ASSOC)) {
        $newphone = $row['phone'];
    }
    if ($newphone){
        echo '账号已存在';
        $_SESSION['next']=0;
    }
    else{
        echo "成功";
        $_SESSION['next']=1;
    }


    mysqli_close($conn);
}

if ($method==3 && $_SESSION['next']){
    $phone=$_POST["phone"];
    $uid=$_POST['uid'];
    $email=$_POST['email'];
    $pwd=$_POST['pwd'];
    mysqli_query($conn , "set names utf8");
    $sql = "INSERT INTO users ".
        "(phone,vname,pw,mail) ".
        "VALUES ".
        "('$phone','$uid','$pwd','$email')";
    mysqli_select_db( $conn, 'RASPI' );
    $retval = mysqli_query( $conn, $sql );
    if(! $retval )
    {
        die('无法插入数据: ' . mysqli_error($conn));
    }
    echo "<a href='index.php'>注册成功 点此跳转</a>";

    $sql = "SELECT vname,pw,mail,phone,id
                FROM users
                WHERE phone=$phone";

    mysqli_select_db($conn, 'RASPI');
    $retval = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($retval, MYSQL_ASSOC)) {
        $id = $row['id'];
    }
    $_SESSION['id']=$id;
    $_SESSION['vname']=$uid;
    $_SESSION['pw']=$pwd;
    mysqli_close($conn);
    $_SESSION['next']=0;
    unset($_SESSION['next']);
}
?>

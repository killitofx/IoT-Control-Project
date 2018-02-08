<?php
/**
 * Created by PhpStorm.
 * User: 14564
 * Date: 2017/10/23
 * Time: 13:29
 */
error_reporting(E_ALL || ~E_NOTICE);
require_once 'function/functions.php';
session_start();
$conn = connectDb();

if (isset($_GET['phone']) && isset($_GET['pw']) && isset($_GET['dev_id']) && isset($_GET['method'])){
    $data_receive=1;
    $phone= $_GET['phone'];
    $pw=$_GET['pw'];
    $dev_id=$_GET['dev_id'];
    $method=$_GET['method'];

}
elseif(isset($_SESSION['id'])){
    $dev_id=$_GET['dev_id'];
    $phone=$_SESSION['phone'];
    $pw=$_SESSION['pw'];
    $method=1;
    $passok=1;

//    $session=1;
    $id=$_SESSION['id'];
}
else{
    echo "data error";
    $data_receive=0;
    $passok=0;
}

if ($data_receive) {
    mysqli_query($conn, "set names utf8");
    $sql = "SELECT vname,pw,mail,phone,id
                FROM users
                WHERE phone=$phone";

    mysqli_select_db($conn, 'RASPI');
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die(mysqli_error($conn));
    }

    while ($row = mysqli_fetch_array($retval, MYSQL_ASSOC)) {
        $vname = $row['vname'];
        $tpw = $row['pw'];
        $id = $row['id'];
    }
    $hpasswd=base64_encode(hash_hmac("SHA1",$tpw,$phone , true));
    if ($pw= $hpasswd){
//    if ($pw == $tpw) {
        $passok = 1;
    } else {
        echo '您的机体好像不认识您，他拒绝了您的访问';
        $passok = 0;
    }
    mysqli_close($conn);
}

//注册设备检测
    $conn = connectDb();
    mysqli_query($conn, "set names utf8");
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
        $arr_dev_all_id[]=  $row['device_id'];
        //$arr_name[]=$row['device_name'];

    }
//    print_r($arr_id);

    mysqli_close($conn);


if ($passok&&$method){
    if (isset($_GET['port']) && isset($_GET['state'])) {
        if ((in_array($dev_id, $arr_dev_all_id)) or $session==1) {
            $port = $_GET['port'];
            $state = $_GET['state'];
            $conn = connectDb();
//$conn = mysqli_connect('localhost','root','');
            if (!$conn) {
                echo '连接失败';
            }
            echo '连接成功';

            $sql = "UPDATE state
        SET state=$state
        WHERE device_id=$dev_id AND port=$port";

            mysqli_select_db($conn, 'RASPI');
            $retval = mysqli_query($conn, $sql);
            if (!$retval) {
                die('无法更新数据: ' . mysqli_error($conn));
            }

            echo '数据更新成功！P' . $port . "=" . $state;
            mysqli_close($conn);

        }
        else{
            echo"您没有权限访问";
        }
    }
    else {
        echo "参数错误";
    }
}

if ($passok&&!$method) {
    if (in_array($dev_id, $arr_dev_all_id)) {

        $conn = connectDb();
        if (!$conn) {
            echo '连接失败';
        }
        // echo '连接成功';

        $sql = "SELECT port,io,state
        FROM state
        WHERE device_id=$dev_id";

        mysqli_select_db($conn, 'RASPI');
        $retval = mysqli_query($conn, $sql);
        if (!$retval) {
            die('查询失败: ' . mysqli_error($conn));
        } else {
            $arr_port = array();
            $arr_state = array();
            $arr_io = array();
            while ($row = mysqli_fetch_array($retval, MYSQL_ASSOC)) {
                $arr_port[] = $row['port'];
                $arr_io[] = $row['io'];
                $arr_state[] = $row['state'];
            }
        }
//    print_r($arr_port);
        if ($_GET['data'] == 'io') {
            echo json_encode($arr_io);
        }
        if ($_GET['data'] == 'state') {
            echo json_encode($arr_state);
        }
        if ($_GET['data'] == 'port') {
            echo json_encode($arr_port);
        }
        mysqli_close($conn);


    }
    else{
        echo "您没有权限访问";
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: 14564
 * Date: 2017/10/25
 * Time: 11:06
 */
//header("Location: 2.php");
session_start();
error_reporting(E_ALL || ~E_NOTICE);
if ($_SESSION['id'])
{
    //获取名称+设备型号
    if ($_POST['select'] && isset($_POST['devname'])) {
        if ($_POST['select']==1){
            $_SESSION['all_port']=12;
            $_SESSION['devname']=$_POST['devname'];
            header("Location: 1.php");
        }
    }
    if($_POST['select']==2){
        $_SESSION['all_port']=16;
        $_SESSION['devname']=$_POST['devname'];
        header("Location: 1.php");
    }
    //获取输出端口
    if (isset($_POST['out_port'])) {

        $_SESSION['out_port']=$_POST['out_port'];
        header("Location: 2.php");

    }

    //插入设备
    if (isset($_POST['create_dev'])){
        echo "提交成功<br>";
        $dbname = "raspi";
        $user_id=$_SESSION['id'];
        $dev_name=$_SESSION['devname'];
        require_once '../function/config.php';
        $conn = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PW, $dbname);
        // 检查链接
        if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        }
        mysqli_query($conn , "set names utf8");
        $sql = "INSERT INTO device (user_id,device_name)
                 VALUES ('$user_id','$dev_name');";
        if ($conn->multi_query($sql) === TRUE) {
            echo "设备创建成功<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $sql = "SELECT device_id FROM device WHERE user_id=$user_id AND device_name='$dev_name'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // 输出数据
            while($row = mysqli_fetch_assoc($result)) {
                echo "设备id: " . $row["device_id"];
                $dev_id=$row["device_id"];
            }
        } else {
            echo "0 结果";
        }
//        $_SESSION['dev_id']=$dev_id;
        echo "<br>";


        //添加端口
        $out_port=$_SESSION['out_port'];
        $all_port=$_SESSION['all_port'];
        $in_port=$all_port-$out_port;
        $sql='';
        for($i=1;$i<=$out_port;$i++){
            $sql .= "INSERT INTO state (device_id, port, io, state, port_name)
            VALUES ('$dev_id', '$i','0', '0','开关$i');";
        }

        for($i=1;$i<=$in_port;$i++){
            $inport_number=$i+$out_port;
            $sql .= "INSERT INTO state (device_id, port, io, state, port_name)
            VALUES ('$dev_id', '$inport_number','1', '0','传感器$i');";
        }
        if ($conn->multi_query($sql) === TRUE) {
            echo "端口创建成功<br><br><br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
        echo"<a href=../detail.php?dev_id=$dev_id>点此跳转到端口控制界面</a><br><br><br>";
        echo"<a href=../index.php>点此跳转到主界面</a><br>";
        unset($_SESSION['out_port']);
        unset($_SESSION['all_port']);
        unset( $_SESSION['devname']);



    }

}
else{
    echo"<a href=../login.php>请登陆</a>";
}
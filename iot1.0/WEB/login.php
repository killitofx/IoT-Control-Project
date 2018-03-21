<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>login</title>
    <?php

    ?>
</head>
<body>

<?php
//error_reporting(E_ALL || ~E_NOTICE);
session_start();

require_once 'function/functions.php';
$conn = connectDb();
if (!$conn)
{
    echo '不好意思数据库好像失联了';
}
else {
  //  echo '创建精神连接中<br>';

        if ($_POST['phone'] && $_POST['pw'])
        {
           // echo '精神连接创建完成<br>';
            $phone = $_POST['phone'];
            $pw = $_POST['pw'];


            mysqli_query($conn, "set names utf8");

            $sql = "SELECT vname,pw,mail,phone,id
                FROM users
                WHERE phone=$phone";

            mysqli_select_db($conn, 'RASPI');
            $retval = mysqli_query($conn, $sql);
            if (!$retval) {
                die('您的机体好像不认识您，他拒绝了您的访问: ' . mysqli_error($conn));
            }

            while ($row = mysqli_fetch_array($retval, MYSQL_ASSOC)) {
                $vname = $row['vname'];
                $tpw = $row['pw'];
                $id = $row['id'];
            }
            if ($pw == $tpw)
            {

                $_SESSION['vname']=$vname;
                $_SESSION['id']= $id;
                $pw=$_SESSION['pw'];
                header('Location:index.php');
            }
            else
            {
                echo '您的机体好像不认识您，他拒绝了您的访问';
            }
        }
        else {
            echo '请输入完整数据';
            }

}
mysqli_close($conn);
?>



</body>
</html>
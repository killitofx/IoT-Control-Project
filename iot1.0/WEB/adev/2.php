<?php
/**
 * Created by PhpStorm.
 * User: 14564
 * Date: 2017/10/25
 * Time: 10:57
 */
session_start();
error_reporting(E_ALL || ~E_NOTICE);
if ($_SESSION["id"]){
    $out_port=$_SESSION['out_port'];
    $all_port=$_SESSION['all_port'];
    $in_port=$all_port-$out_port;
    $dev_name=$_SESSION['devname'];

    if ($all_port==12){
        $dev_model='Arduino';
    }elseif($all_port==16){
        $dev_model='Raspberry';
    }else{
        $dev_model= "不存在该设备";
    }
}
else{
    echo "<a href=../login.php>请登陆</a>";
    $out_port=0;
    $all_port=0;
    $in_port=0;
    $dev_name="不存在该设备";
    $dev_model= "不存在该设备";
}




//echo "设备型号".$dev_model;
//echo "<br>";
//echo "设备名称".$_SESSION['devname'];
//echo "<br>";
//echo "端口总数".$all_port;
//echo "<br>";
//echo "输出端口".$out_port;
//echo "<br>";
//echo "输入端口".$in_port;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>确认</title>
</head>
<body>
<table width="300" border="0"align="center">
<?php
echo "
    <tr>
        <td>设备型号;</td>
        <td>$dev_model</td>
    </tr>
    <tr>
        <td>设备名称:</td>
        <td>$dev_name</td>
    </tr>
    <tr>
        <td>端口总数:</td>
        <td> $all_port</td>
    </tr>
    <tr>
        <td>输出端口:</td>
        <td> $out_port</td>
    </tr>
    <tr>
        <td>输入端口:</td>
        <td>$in_port</td>
    </tr>";
?>


    <tr>
        <td colspan="2"><center><form id="form1" name="form1" method="post" action="sever.php">
                    <input type="submit" name="create_dev" id="ok" value="确认" />
                </form></center></td>
    </tr>
</table>
</body>
</html>


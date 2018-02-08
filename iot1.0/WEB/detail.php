<DOCTYPE html xmlns="http://www.w3.org/1999/html">
    <html>
    <head>
        <meta charset="UTF-8">
        <title>detail</title>
        <script src = "function/jquery-3.2.1.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/datail-style.css">
<!--        <script src = "function/main.js"></script>-->
    </head>
    <body>




<div id="detail">

    <?php
    /**
     * Created by PhpStorm.
     * User: 14564
     * Date: 2017/10/23
     * Time: 10:10
     */
    error_reporting(E_ALL || ~E_NOTICE);
    require_once 'function/functions.php';
    session_start();
    $arr_io=array();
    $arr_port=array();
    $arr_state=array();
    //获取参数
    if (isset($_SESSION['vname'])&&isset($_GET['dev_id'])) {
        $dev_id = $_GET['dev_id'];
        $vname = $_SESSION['vname'];
        $id = $_SESSION['id'];

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
        if (in_array($dev_id, $arr_dev_all_id)){
            $check_value=1;
        }
        else{$check_value=0;
        echo "您无权访问";}
    }
//        } else {
//            $check_value = 0;
//        }
//    }
    else{
        echo '非法访问';
    }

//设备菜单
    if($check_value){
        echo "<a href=\"cdev/index.php\">修改端口</a>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='deldev/del_dev.php'>删除设备</a>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php'>返回</a>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;设备id：".$dev_id;
        $_SESSION['del_dev_id']=$dev_id;
        $_SESSION['del_dev_name']=$_GET['dev_name'];
    }

//列出需要写入的数据
    if ($check_value){
        require_once 'function/functions.php';
        $conn=connectDb();
        if (!$conn)
        {
            echo '连接失败';
        }
        //echo '连接成功';
        mysqli_query($conn, "set names utf8");
        $sql = "SELECT port,io,state,port_name
        FROM state
        WHERE device_id='$dev_id' AND io=0;";

        mysqli_select_db( $conn, 'RASPI' );
        $retval = mysqli_query( $conn, $sql );
        if(! $retval )
        {
            die('无法读取数据: ' . mysqli_error($conn));
        }
//        echo '数据读取成功！';
//        echo'<br>';

        while($row = mysqli_fetch_array($retval, MYSQL_ASSOC)) {
            $arr_port[]=  $row['port'];
            $arr_io[]=$row['io'];
            $arr_state[]=  $row['state'];
            $arr_port_name[]=$row['port_name'];
        }
        $all_num=count($arr_port);
        mysqli_free_result($retval);
        mysqli_close($conn);
    }

    //按钮显示
    for($i=0;$i<$all_num;$i++)
    {
        echo"    <p>p$arr_port[$i]  $arr_port_name[$i]</p>
    <button id=p$arr_port[$i]o>open</button>
    <button id=p$arr_port[$i]c>close</button>
    结果：<span id = result$arr_port[$i]>p$arr_port[$i]=$arr_state[$i]</span>
    <br>";
    }
    ?>

<!--按钮脚本-->
<script>
    <?php
    echo " $(document).ready(function() {";
    for($i=0;$i<$all_num;$i++){
    echo "
            $(\"#p$arr_port[$i]o\").click(function () {
            $.get(\"api.php\", {dev_id: $dev_id , state: \"1\",port:$arr_port[$i]}, function (data) {
                $(\"#result$arr_port[$i]\").text(data);
            });
        });
        $(\"#p$arr_port[$i]c\").click(function () {
            $.get(\"api.php\", {dev_id: $dev_id, state: \"0\",port:$arr_port[$i]}, function (data) {
                $(\"#result$arr_port[$i]\").text(data);
            });
        });

   ";}
    echo " });";
?>
</script>

<?php

//读取数据
if ($check_value){
//    require_once 'function/functions.php';
    $conn=connectDb();
    if (!$conn)
    {
        echo '连接失败';
    }
    //echo '连接成功';
    mysqli_query($conn, "set names utf8");
    $sql = "SELECT port,io,state,port_name
        FROM state
        WHERE device_id='$dev_id' AND io=1;";

    mysqli_select_db( $conn, 'RASPI' );
    $retval = mysqli_query( $conn, $sql );
    if(! $retval )
    {
        die('无法读取数据: ' . mysqli_error($conn));
    }
//        echo '数据读取成功！';
//        echo'<br>';

    while($row = mysqli_fetch_array($retval, MYSQL_ASSOC)) {
        $arr_read_port[]=  $row['port'];
        $arr_read_state[]=  $row['state'];
        $arr_read_port_name[]=$row['port_name'];
    }
    $all_read_num=count($arr_read_port);
    mysqli_free_result($retval);
    mysqli_close($conn);
}

for($i=0;$i<$all_read_num;$i++)
{
    echo"    <br><p>p$arr_read_port[$i]  $arr_read_port_name[$i] value:$arr_read_state[$i] </p> ";
}


//完整设备菜单
//if (!$all_num and !$all_read_num and $check_value){
//    echo "<div id='detail_text'><a href=\"add_port.php\">添加端口</a>";
//}
//elseif($check_value){
//    echo "<br><br>";
//    echo "<a href=\"cdev/index.php\">修改端口</a>";
//    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='deldev/del_dev.php'>删除设备</ah>";
//    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;设备id：".$dev_id;
//    $_SESSION['del_dev_id']=$dev_id;
//    $_SESSION['del_dev_name']=$_GET['dev_name'];
//}
?>


</div>

    </div>
    </body>
    </html>

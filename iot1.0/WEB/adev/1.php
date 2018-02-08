<?php
session_start();
error_reporting(E_ALL || ~E_NOTICE);

?> 

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>添加设备</title>
</head>
<body>
<form name="form1" method="post" action="sever.php"> 
<label>
输出口数量
    <select name="out_port">
        <option value="0">请选择</option>
        <?php
        for ($i=0;$i<=$_SESSION['all_port'];$i++){
            echo "<option value=\"$i\">$i</option>";
        }
        $_SESSION['all_poet']=0;
        ?>
</select> 
</label>
<label> 
    <input type="submit" name="Submit" value="提交"> 
</label> 
</form>
</body>
</html>
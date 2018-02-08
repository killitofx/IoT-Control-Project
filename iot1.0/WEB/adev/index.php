<?php


?> 
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>添加设备</title>
</head>
<body>


<form name="form1" method="post" action="sever.php"> 
    <label> 设备选择
        <select name="select">
            <option value="0">请选择</option>
            <option value="1">Arduino</option> 
            <option value="2">Raspberry</option> 
        </select> 
    </label> 

    <label>请输入设备名称
        <input type="text" name="devname">
    </label>

    <label> 
        <input type="submit" name="Submit" value="提交"> 
    </label> 

</form>


</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>logout</title>
</head>
<body>

<?php

session_start();
session_destroy();
echo"<script>alert('登出成功');history.go(-1);</script>";


?>
</body>
</html>



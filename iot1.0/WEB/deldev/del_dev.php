<!DOCTYPR html>
<html>
<head>
    <meta charset="UTF-8">
    <title>删除设备</title>
    <style>
        #table{
            text-align: center;
        }
    </style>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: 14564
 * Date: 2017/10/25
 * Time: 14:29
 */
session_start();
error_reporting(E_ALL || ~E_NOTICE);
$dev_id=$_SESSION['del_dev_id'];
$dev_name=$_SESSION['del_dev_name'];

//if (isset($_SESSION['dev_id'])){
//    echo "确定删除此设备吗？<br>";
//    echo "id:".$_SESSION["dev_id"];
//    echo "<br>名称：".$dev_name;
//}

echo "<table width=\"300\" border=\"1\" align=\"center\"id = table>
  <tr>
    <td colspan=\"2\" height=\"40\">确定删除此设备吗？</td>
  </tr>
  <tr>
    <td>id</td>
    <td height=\"40\">$dev_id</td>
  </tr>
  <tr>
    <td height=\"40\" width='142'>名称</td>
    <td width='142'>$dev_name</td>
  </tr>
  <tr>
    <td height=\"40\"><center><form id=\"form1\" name=\"form1\" method=\"post\" action=\"do.php\">
      <input type=\"submit\" name=\"nodel\" id=\"我拒绝\" value=\"我拒绝\" />
    </form></center></td>
    <td><center><form id=\"form2\" name=\"form2\" method=\"post\" action=\"do.php\">
      <input type=\"submit\" name=\"del\" id=\"朕准了\" value=\"朕准了\" />
    </form></center></td>
  </tr>
  </tr>
</table>";
?>

</body>
</html>

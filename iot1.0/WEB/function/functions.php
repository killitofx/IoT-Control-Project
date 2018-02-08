<?php
/**
 * Created by PhpStorm.
 * User: 14564
 * Date: 2017/8/18
 * Time: 16:46
 */
require_once 'config.php';
function connectDb()
{
    return mysqli_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PW);

}

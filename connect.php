<?php
require_once('config.php');


$dbname = "test_dt";
//连接数据库
$con = new mysqli($servername, $username, $password, $dbname,$port);
mysqli_query($con,"set character set 'utf8'");
mysqli_query($con,"set names 'utf8'");


if($con->connect_error){
	die('连接失败');
}

?>
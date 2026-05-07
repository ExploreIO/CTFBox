<?php
$db_host = '127.0.0.1';
$db_user = 'root';
$db_pass = 'rootroot';
$db_name = 'ilove';

$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if(!$con){
    die("连接出错".mysqli_connect_error());
}
?>
<?php
$db_host="sqld.duapp.com";//数据库地址
$db_port="4050";//数据库端口
$db_name="";//数据库名
$db_user="";//数据库用户名
$db_pass="";//数据库密码
$dsn="mysql:host=".$db_host.";dbname=".$db_name.";port=".$db_port;
try{
	$db=new PDO($dsn,$db_user,$db_pass);
}catch(Exception $e){
	exit('链接数据库失败:'.$e->getMessage());
}
$db->exec("set names utf8");
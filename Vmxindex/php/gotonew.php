<?php
//再次验证当前的登录id是否是1
session_start();
    
	$jiami = $_SESSION["Vmxid"];
	//后台验证
	//把传进来的id转化一下，解密
	//"vmx245".($row["id"]+315);
	//去掉前三位
	$userid =  intval(substr($jiami,6))-315;
	if($userid==1){
		header("Location: ../picture/newPic.php"); 	
		exit;
	}else{
		echo "后台验证失败，小伙，别看前端代码破解了";
	}

?>
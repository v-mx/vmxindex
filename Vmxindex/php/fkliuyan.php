<?php
	include_once "link-user.php";
	if($_POST["a"] == 1){

		$t = $_POST["t"];
		$c = $_POST["c"];
		$ip = $_POST["ip"];
		
//		$jiami = $_POST["user"];
//		//后台验证
//		//把传进来的id转化一下，解密
//		//"vmx245".($row["id"]+315);
//		//去掉前三位
//		$userid =  intval(substr($jiami,6))-315;
//		
//		//根据id查找出用户名
//		$query = "select * from users where id = '$userid'";
//		$result = mysql_query($query);
//		if(mysql_num_rows($result)>0){
//			$row = mysql_fetch_array($result);//输出匹配到的用户
//			$username = $row["username"];
//		}
		
		
		$times1 = time();
		$times2 = date('Y-m-d H:i:s', "$times1");
		
		//添加数据
		$query = "insert into fkliuyantext (name,time1,c,title) values ('$ip','$times2','$c','$t')";
			mysql_query($query);
			if(mysql_affected_rows()>0){
				echo '{"msg":"1","color":"green"}';
			}else{
				echo '{"msg":"0","color":"red"}';
			}
	}

?>
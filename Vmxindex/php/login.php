<?php 
    include_once "link-user.php";
	
	if($_POST["action"] == "yanzheng"){
		$user = $_POST["user"];
		$logB = $_POST["logB"];
		
		$query = "select * from users where username = '$user'";
		$result = mysql_query($query);
		if(mysql_num_rows($result)>0){
			//判断是注册还是登录
			if($logB == "logon"){
				echo '{"msg":"用户名已存在"}';
			}else if($logB == "login"){
				echo '{"msg":"输入密码","color":"green"}';
			}
			
		}else{
			if($logB == "logon"){
				echo '{"msg":"用户名可用","color":"green"}';
			}else if($logB == "login"){
				echo '{"msg":"用户名不存在","color":"red"}';
			}
		}
		
		//注册信息或登陆，点击按钮时触发
	} else if($_POST["action"] == "reg"){ 
		$user = $_POST["user"];
		$pass = $_POST["pass"];
		$logB = $_POST["logB"];
		
		
		//是登录的
		if($logB == "login"){
			$query = "select * from users where username = '$user' and password = '$pass'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 1){
				//登录成功，把数据保存到session，用一个算法加密 
				$row = mysql_fetch_array($result);//输出匹配到的用户
				session_start();
				$jiami = "vmx245".($row["id"]+315);
				$_SESSION["Vmxid"] = $jiami;//把提取到的id保存在session里供下一个页面使用
				//返回一个用户名，第一次刷新页面时使用
				echo '{"msg":"登录成功，欢迎~","yanzheng":"true","color":"green","userid":"'.$jiami.'","id":"'.$row["id"].'"}';
			}else{
				echo '{"msg":"登录不成功,请重新登录！","yanzheng":"false","color":"red"}';
			}
			//是注册的
		}else if($logB == "logon"){
			//2次验证
			if($user==""){
				echo '{"msg":"用户名不能为空，注册失败"}';
			}else{
				//2次验证
				$query = "select * from users where username = '$user'";
				$result = mysql_query($query);
				if(mysql_num_rows($result)>0){
					echo '{"msg":"用户名已存在，注册失败","color":"red"}';
				}else{
					//添加查找ip
					
					
					$times1 = time();
					$times2 = date('Y-m-d H:i:s', "$times1");
					$query = "insert into users (username,password,times) values('$user','$pass','$times2')";
					mysql_query($query);
					if(mysql_affected_rows()>0){
						//读取注册后的id,直接登录,待添加
//						session_start();
//						$_SESSION["Vmxid"] 
						
						$a =  mysql_insert_id();
						echo '{"msg":"注册成功，请返回登录","color":"green"}';	
					}else{
						echo '{"msg":"注册失败，请重新注册","color":"red"}';	
					}
				}
			}
					
		}
		//是注销的
	}else if($_POST["action"] == "logout"){
		session_start();
		session_destroy();
		 
		 //判断id是否还存在
//		 if(isset($_SESSION["id"])){//第一次注销成功，但当前页面的$_SESSION["id"]还在，所以这样判断是有漏洞的
//			echo '{"msg":"注销失败","logout":"0"}';
//		 }else{
			echo '{"msg":"注销成功，即将返回登录页面~","logout":"1"}';
//		 }
	}
	
	
		
	
?>
<?php 
    include_once "link-user.php";
	
	if($_POST["a"] == 1){
		$m = $_POST["m"];
		$t = $_POST["t"];
		$c = $_POST["c"];
		$s = $_POST["s"];
		
		$times1 = time();
		$times2 = date('Y-m-d H:i:s', "$times1");
		
		//添加数据
		$query = "insert into logtext (time1,time2,c,title,img,color) values ('$times1','$times2','$c','$t','$m','$s')";
			mysql_query($query);
			if(mysql_affected_rows()>0){
				echo '{"msg":"添加成功","color":"green"}';
			}else{
				echo '{"msg":"添加失败","color":"red"}';
			}
	}
	
?>
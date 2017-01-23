<?php
include_once 'link-user.php';
	define("PAGESIZE", 12);
	$count = 0;
	$page = 0;
	
	if(isset($_POST["page"])){
		$page = $_POST["page"];
	}else{
		$page = 0;
	}
	
	$query = "select count(id) from logtext";//得到一共有到少记录
	$result = mysql_query($query);
	if(mysql_num_rows($result)>0){
		$row =  mysql_fetch_row($result);
		$count = $row[0];//共有到少记录
	}
	
	$size = ceil($count / PAGESIZE);//向上取整,一共可以显示多少页
	
	//获取数据
	$index = $page*PAGESIZE;//当前需要从哪里读取数据
	$query = "select * from logtext order by time1 desc limit $index,".PAGESIZE;
	$result = mysql_query($query);
	if(mysql_num_rows($result)>0){
		//此处需改进，把他们添加到数组里，不使用拼接的方法
		//$arr[] = $row;
		$textmsgstr="";
		while($row = mysql_fetch_array($result)){
			$textmsgstr=$textmsgstr.json_encode($row).",";
		}

	} 
	$textmsgstr= "[".$textmsgstr.$size."]";//里面存储的是返回的对象，数组最后一个存储的是页数
	echo $textmsgstr;
?>
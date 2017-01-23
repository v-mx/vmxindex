<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<style type="text/css">
		textarea{
			width: 300px;
			font-size: 30px;
			height: 300px;
		}
		span{
			font-size: 60px;
		}
	</style>
	<body>
		<textarea name="" rows="" id="c" placeholder="请输入留言内容"></textarea>
		<textarea name="" rows="" id="t" placeholder="请输入标题"></textarea>
		<textarea name="" rows="" id="m" placeholder="请输入图片链接"></textarea>
		
<!--
		<input type="tex" name="t" id="t" value="" placeholder="标题"/>

		<input type="text" name="c" id="c" value="" placeholder="标题"/>

		<input type="text" name="m" id="m" value="" placeholder="标题"/>-->

		<p class="reminder">使用花瓣上的连接可以不被屏蔽</p>
		<span >添加</span>
	</body>
	<script type="text/javascript" src="../js/jquery-1.8.3.min.js">

	</script>
	<script type="text/javascript">
	$("span").on("click",news);
function news() {
			Colors = "rgba(" + getRandom(0, 250) + "," + getRandom(0, 250) + "," + getRandom(0, 250) + ",0.6)";
	$.ajax({

		type: "post",
		url: "../php/new.php",
		async: true,
		data: {
			m: $("#m").val(),
			c: $("#c").val(),
			t: $("#t").val(),
			s: Colors,
			a:1
		},
		dataType: "json",
		success: mainR,
		error: errorsR
	});
}

//返回一个随机
function getRandom(min, max) {
			return Math.round(Math.random() * (max - min) + min);
		}

function mainR(data) {
	console.log(data);
	$(".reminder").css("color", "red");
	$(".reminder").html("添加成功");
}

function errorsR(data) {
	$(".reminder").css("color", "red");
	$(".reminder").html("服务器无响应，请重试");
	console.log(data);
}</script>
</html>

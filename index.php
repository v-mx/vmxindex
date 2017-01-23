<?php
include_once "Vmxindex/php/link-user.php";
//	<!--读取已登录用户信息-->
session_start();

//获取访客ip
//上线之后打开，
$ip = $_SERVER["REMOTE_ADDR"];

$times1 = time();
$times2 = date('Y-m-d H:i:s', "$times1");
//读取，没有就新建
$query = "select * from fangke";
$result = mysql_query($query);

if (mysql_num_rows($result) > 0) {
	//读取id1的数据
	$query = "select * from fangke where id = 1";
	$result = mysql_query($query);
	if (mysql_num_rows($result) == 1) {
		$row = mysql_fetch_assoc($result);
		$num = $row["num"] + 1;
		$query = "update fangke set num = '$num' where id=1";
		mysql_query($query);

		//echo $num."访问量";
		//写入时间
		$query = "insert into times(times,fangkenum,ip) values('$times2','$num','$ip')";
		mysql_query($query);
		if (mysql_affected_rows() == 1) {
			//				echo "添加时间成功";
		} else {
			//				echo "操作时间失败";
		}

	}
} else {
	//新建一条数据
	$query = "insert into fangke(num) values(0)";

	mysql_query($query);
	if (mysql_affected_rows() == 1) {
		echo "添加成功";
	} else {
		echo "操作失败";
	}
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8" />
		<meta name="description" content="">
		<meta name="keywords" content="" />
		<meta name="author" content="">

		<title>V-mx首页</title>
		<link rel="shortcut icon" href="Vmxindex/img/favicon.ico" type="image/x-icon">

		<link rel="stylesheet" type="text/css" href="Vmxindex/css/index-all.css"/>
		<link rel="stylesheet" type="text/css" href="Vmxindex/css/index.css"/>
		<link rel="stylesheet" type="text/css" href="Vmxindex/css/animate-all.css"/>
		<link rel="stylesheet" type="text/css" href="Vmxindex/css/animate.css"/>
		<script src="Vmxindex/js/jquery-1.8.3.min.js" type="text/javascript" charset="utf-8"></script>
		<!--流星雨-->
		<script type="text/javascript" src="Vmxindex/js/stars.js"></script>
	</head>
	<body>
		<div class="big-box" id="top">
			
			<header class="index">

				<!--轮播图翻页点-->
				<ul class="slick-dots" style="display: block;" role="tablist">
					<li class="dots"  id="slick-slide00">
						<span class="dot active"></span>
					</li>
					<li class="dots"  id="slick-slide01" class="">
						<span class="dot"></span>
					</li>
					<li class="dots"  id="slick-slide01" class="">
						<span class="dot"></span>
					</li>
				</ul>
				<!--首页的添加信息-->
				<div class="inner">
					<!--轮播-->
					<div class="lunbo-wrap">
						<div class="lunbo-wrap2">

							<ul class="index-lunbo">
								<li class="bg bg3  h-ani3">

									<div class="slogan-wrapper">
										<span class="flys-ani">&#xe602;</span>

										<!--轮播点击进入-->
										<a href="" class="click-go"></a>
										<div class="slogan text">
											<span class=""> V-mx </span><span class="bc-color-dribbble-5 t"> 俱乐部 </span>

										</div>
										<div class="version text">
											童年的那个纸飞机，从二维到三维

										</div>
									</div>

								</li>
								<li class="bg bg1 h-ani1">
									<div class="slogan-wrapper">
										<span class="flys-ani">&#xe60c;</span>

										<!--轮播点击进入-->
										<a href="Vmxindex/Zresume/index.html" target="_blank" class="click-go"></a>
										<div class="slogan text">
											<a href="Vmxindex/Zresume/index.html" target="_blank">
												N设计  <span class="bc-color-dribbble-2 t">解决方案</span>
											</a>
										</div>
										<div class="version text">
											硬件，互联网，统统搞定
										</div>

									</div>
								</li>
								<li class="bg bg2  h-ani2">

									<div class="slogan-wrapper">
										<span class="flys-ani flys-ani-2">&#xe609;</span>
										<!--轮播点击进入-->
										<a href="Vmxindex/picture/picture.php" target="_blank" class="click-go"></a>
										<div class="slogan text">
											<a href="Vmxindex/picture/picture.php" target="_blank">
												<span class="bc-color-dribbble-5 t">小设计</span>，工作之外的新世界
											</a>
										</div>
										<div class="version text">
											记录点滴，诠释生活，做一个有趣的人
										</div>
									</div>

								</li>
								<li class="bg bg3  h-ani3">

									<div class="slogan-wrapper">
										<!--飞机-->
										<span class="flys-ani">&#xe602;</span>
										<!--轮播点击进入-->
										<a href="javascript:void(0);" class="click-go"></a>
										<div class="slogan text">
											<span class=""> V-mx </span><span class="bc-color-dribbble-5 t"> 俱乐部 </span>

										</div>

										<div class="version text">
											童年的那个纸飞机，从二维到三维
										</div>
									</div>

								</li>
								<li class="bg bg1 h-ani1">
									<div class="slogan-wrapper">
										<span class="flys-ani">&#xe60c;</span>

										<!--轮播点击进入-->
										<a href="Vmxindex/Zresume/index.html" target="_blank" class="click-go"></a>
										<div class="slogan text">
											<a href="Vmxindex/Zresume/index.html" target="_blank">
												N设计  <span class="bc-color-dribbble-2 t">解决方案</span>
											</a>
										</div>
										<div class="version text">
											硬件，互联网，统统搞定
										</div>

									</div>
								</li>
							</ul>
						</div>
					</div>

					<!-- 导航列表公用!!!!!!!!!!!!!!!!!!!!!! -->
					<div class="nav-wrapper clearfix">
						<div class="logo animated infinite bounce">

						</div>
						
						<nav class="nav">
							<a href="javascript:void(0);" class="active">
								首页
							</a>
							<a href="javascript:void(0);" target="_blank">
								解决方案类别
							</a>
							<a href="Vmxindex/picture/picture.php" target="_blank">
								贴图日志
							</a>
							<a href="https://duyangsir.github.io/"  target="_blank">
                                	博客
                            </a>
							<a href="javascript:void(0);" target="_blank">
								V-mx俱乐部
							</a>

							<a href="javascript:void(0);" class="btn personal org open logons">
								快速注册
							</a>
							<a href="javascript:void(0);" class="login btn open logins">
								登录网站
							</a>

							<!--滑块-->
							<i class="nav-fly"></i>
						</nav>
					</div>
					<!--首页添加的样式-->
					<div class="bd">
						<div class="buttons">

							<a href="javascript:void(0);" class="btn personal open logons">
								快速注册
							</a>
							<a href="javascript:void(0);" class="btn org logins fkliuyan">
								给我留言
							</a>
							<a href="javascript:void(0);" class="btned" id="cancel">
								您已登录，点击注销
							</a>
						</div>

					</div>

				</div>
			</header>
			<!--留言悬浮框-->
			<!--提示框-->
			<div class="reminder-wrap">
				<p class="reminder2"></p>
			</div>

			<section class="liuyan-box">

				<!--关闭-->
				<div class="liuyan-close">
					<span>&#xe600;</span>
				</div>
				<!--输入区-->
				<div class="w-box">
					<input type="text" name="liuyan-name" id="liuyan-name" value="" maxlength="12" placeholder="请输入留言标题或昵称等自定义信息"/>
					<textarea name="liuyan-c" rows="" cols="" id="liuyan-c" maxlength="300" placeholder="访客你好~请输入留言内容~"></textarea>					
                	
                	
 <!--提交-->
					<button class="liuyan-btn">
					提交留言
					</button>

				</div>

			</section>
			<!--==========注册悬浮框===============-->
			<div class="wrap-login forwards">
				<!--存储id-->
				<input type="hidden" name="" id="ids" value="<?php
				if (isset($_SESSION["Vmxid"])) {
					echo $_SESSION["Vmxid"];
				} else {
					echo "nologin";
				}
				?>"/>
				<!--存储ip-->
				<input type="hidden" name="" id="ips" value="<?php

				echo $ip;
				?>" />
				<section class="user-box">
					<section class="login " id="login-box">
						<h3>快速登录</h3>

						<p>
							<input type="text" name="name" class="intext" id="name1" maxlength="12" value="" onchange="ajaxPostY()" placeholder="用户名"/>
						</p>
						<p>
							<input type="password" name="pass" class="intext" id="pass1" maxlength="12" value="" placeholder="密码"/>
						</p>

						<input type="button" name="login" class="btns loginbtn" id="login1" value="登录" />
						<input type="button" name="logon" class="btns logonbtn" id="logon1" value="注册" />
					</section>
					<section class="logon" id="logon-box">
						<h3>注册登录</h3>

						<p>
							<input type="text" name="name" class="intext" id="name2" maxlength="12" value="" onchange="ajaxPostY()" placeholder="用户名（注册）"/>
						</p>
						<p>
							<input type="password" name="pass" class="intext" id="pass2" maxlength="12" value="" placeholder="密码（注册）"/>
						</p>
						<!--验证码-->
						<div class="code-box">
							<img src="Vmxindex/php/code.php" class="code-img"/>
							<input type="text" name="content" maxlength="4" id="code-content" value="" placeholder="输入验证码"/>
							<span>看不清？点击图片更换</span>
						</div>
						<input type="button" name="login" class="btns loginbtn" id="login2" value="登录" />

						<input type="button" name="logon" class="btns logonbtn" id="logon2" onclick="ajaxPostR()" value="注册" />
					</section>

					<p class="reminder">
						请选择登录或注册
					</p>
				</section>
				<!--关闭-->
				<div class="login-close">
					<span>&#xe600;</span>
				</div>
			</div>
			<!--倒计时-->
			<section class="down-time">
				<div class="time-wrap">
					<div class="box-wrap">
						<!--动画帧-->
						<span id="fpsbox"> FPS: <span id="fps"></span> </span>

						<!--碰撞-->
						<div class="wrap-time-pz">
							<div class="inner inner1-times">
								<span>&#xe60e;</span>
							</div>
							<div class="inner inner2-times">
								<span>&#xe60d;</span>
							</div>
						</div>
						<div class="times-box">
							<p >
								V-mx Year
							</p>
							<span id="times"></span>
						</div>

					</div>

				</div>
			</section>
			<!--返回顶部-->
			<div class="go-top">
				<span>&#xe603;</span>
			</div>
			<!--侧边目录选择-->
			<div class="click-menu">
				<ul class="menus">
					<li class="menu">
						<a href="javascript:void(0);">
							<span id=""> TOP </span>
							<i class="active"></i>
						</a>
					</li>
					<li class="menu">
						<a href="javascript:void(0);">
							<span id=""> 解决方案类别 </span>
							<i></i>
						</a>
					</li>
					<li class="menu">
						<a href="javascript:void(0);">
							<span id=""> 贴图留言 </span>
							<i></i>
						</a>
					</li>
					<li class="menu">
						<a href="javascript:void(0);">
							<span id=""> CSS3展示 </span>
							<i></i>
						</a>
					</li>
					<li class="menu">
						<a href="javascript:void(0);">
							<span id=""> V-mx俱乐部 </span>
							<i></i>
						</a>
					</li>
					<li class="menu">
						<a href="javascript:void(0);">
							<span id=""> HTML5 </span>
							<i></i>
						</a>
					</li>
					<li class="menu">
						<a href="javascript:void(0);">
							<span id=""> 我的世界 </span>
							<i></i>
						</a>
					</li>
					<li class="menu">
						<a href="javascript:void(0);">
							<span id=""> 联系我 </span>
							<i></i>
						</a>
					</li>
				</ul>
			</div>

			<!--简历-->
			<section class="tronclass" id="a">
				<div class="bg"></div>
				<div class="bd">
					<div class="title sub-title text" >
						前端工程师 简历
					</div>
					<div class="desc text">
						<!--直接写入文档在新浪云的url-->
						<a href="http://1.dqsir.applinzi.com/Vmxindex/php/%E7%AE%80%E5%8E%86%E4%B8%8B%E8%BD%BD%E6%B5%8B%E8%AF%95.docx" class="downfile">
							点此处下载简历文档
						</a>
					</div>
					<div class="css-wrapper">
						<a href="Vmxindex/Zresume/index.html" target="_blank">
							<span>&#xe60e;点击进入</span>
						</a>
						<div class="jl-show">

						</div>
					</div>

				</div>

			</section>

			<!--贴图墙-->
			<section class="college" id="b">
				<div class="bd">
					<div class="title text">
						贴图墙
					</div>
					<div class="sub-title text">
						前端生涯的零碎记忆，登录可评论（
						<a href="Vmxindex/picture/picture.php" target="_blank" >
							点击进入
						</a>
						）
					</div>
					<div class="Message-show">
						<span>&#xe613;</span>
						<a href="Vmxindex/picture/picture.php" class="pic-show-box"></a>
						<a href="Vmxindex/picture/picture.php" class="pic-show-box"></a>
						<a href="Vmxindex/picture/picture.php" class="pic-show-box"></a>
						<a href="Vmxindex/picture/picture.php" class="pic-show-box"></a>
						<a href="Vmxindex/picture/picture.php" class="pic-show-box"></a>
						<a href="Vmxindex/picture/picture.php" class="pic-show-box"></a>
						<a href="Vmxindex/picture/picture.php" class="pic-show-box"></a>
						<a href="Vmxindex/picture/picture.php" class="pic-show-box"></a>

					</div>

				</div>
			</section>
			<!--css3-->
			<section class="train css3" id="c">
				<div class="bd">
					<div class="title text">
						CSS3
					</div>
					<div class="sub-title text">
						展现立体，CSS3的强大渲染
					</div>
					<div class="inner" id="cssshow-box">

						<!--左右按钮-->
						<span  class="next btn-s"> <s class="change-page"></s> </span>
						<span  class="prev btn-s"> <s class="change-page"></s> </span>

						<ul class="page-move">
							<li>
								<iframe class="css-show" src="Vmxindex/game/Css3D/GRID/GRID.html" scrolling="no">

								</iframe>
							</li>

							<li>
								<iframe class="css-show" src="Vmxindex/game/Css3D/3Df/3D.html" scrolling="no">

								</iframe>
							</li>
							<li>
								<iframe class="css-show" src="Vmxindex/game/Css3D/SPHERE/sphere.html" scrolling="no">

								</iframe>
							</li>
							<li>
								<iframe class="css-show" src="Vmxindex/game/Css3D/GRID/GRID.html" scrolling="no">

								</iframe>
							</li>
							<li>
								<iframe class="css-show" src="Vmxindex/game/Css3D/3Df/3D.html" scrolling="no">

								</iframe>
							</li>

						</ul>
						<a href="javascript:void(0);"></a>

					</div>
				</div>
			</section>
			<!--点击重新加载-->
			<script type="text/javascript">$(".inner").on("click", function() {
	$(".css-show").eq(2).attr("src", "Vmxindex/game/Css3D/SPHERE/sphere.html");
	$(".css-show").eq(4).attr("src", "Vmxindex/game/Css3D/3Df/3D.html");
	$(".css-show").eq(1).attr("src", "Vmxindex/game/Css3D/3Df/3D.html");

	$(".css-show").eq(3).attr("src", "Vmxindex/game/Css3D/GRID/GRID.html");
	$(".css-show").eq(0).attr("src", "Vmxindex/game/Css3D/GRID/GRID.html");

})</script>

			<!--展示-->
			<section class="journal" id="d">
				<div class="bd">
					<div class="title text">
						V-mx俱乐部
					</div>
					<div class="sub-title text">
						生活，工作
					</div>
					<div class="log-show">
						<a href="javascript:void(0);">
							<span id="flyss">&#xe602;</span>

						</a>

					</div>

				</div>
			</section>

			<!--游戏-->
			<section class="train" id="e">
				<div class="bd">
					<div class="title text">
						****
					</div>
					<div class="sub-title text">
						*******
					</div>
					<div class="inner">
						<div class="game-show">
							<div class="index-game">

								<!--填充区域-->
								
							</div>
						</div>

						<div class="games-show">

						</div>
					</div>
					<!--<div class="title text games" style="">
					更多游戏展示
					</div>-->
				</div>
			</section>
			<script type="text/javascript">$(".games").on("click", function() {
	$(".games-show").css({
		display: "block"
	})
	$(".game-show").css({
		display: "none"
	})
})</script>

			<!--圣经-->

			<section class="client-comments" id="f">
				<a href="javascript:void(0);">
					<!--世界地图-->
					<div class="word-bg-box">
						<span class="word-bg">&#xe60f;</span>

					</div>

					<div class="bd">
						<div class="title text">
							世界那么大，做好准备去看看
						</div>
						<ul class="comments clearfix">
							<li class="comment">
								<span class="icon icon-rocket">&#xe611;</span>
								<div class="desc text">
									若是你的右眼叫你跌倒，就剜出来丢掉，宁可失去百体中的一体，不叫全身丢在地狱里。
									<br />
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									若是右手叫你跌倒，就砍下来丢掉，宁可失去百体中的一体，不叫全身下入地狱。
								</div>
								<div class="school text">
									马太福音 5:29-30
								</div>
							</li>
							<li class="comment">
								<span class="icon icon-drink">&#xe610;</span>
								<div class="desc text desc2">
									你们要进窄门，因为引到灭亡，那门是宽的，路是大的，进去的人也多；引到永生，那门是窄的，路是小的，找着的人也少。
								</div>
								<div class="school text">
									马太福音 7:13-14
								</div>
							</li>
							<li class="comment">
								<span class="icon icon-airplane">&#xe612;</span>
								<div class="desc text">
									爱是恒久忍耐，又有恩慈。爱是不嫉妒。爱是不自夸。不张狂。不做害羞的事。不求自己的益处。不轻易发怒。不计算人的恶。不喜欢不义。只喜欢真理。凡事包容。凡事相信。凡事盼望。凡事忍耐。爱是永不止息。
								</div>
								<div class="school text">
									哥林多前书 13:4-8
								</div>
							</li>
						</ul>
					</div>
				</a>
			</section>

			<!--底部公用-->
			<footer id="footer">
				<section class="register-wrapper">
					<div class="bd">
						<div class="buttons">
							<a href="javascript:void(0);" class="btn open personal logons">
								注册登录
							</a>
							<a href="javascript:void(0);" class="btn org logins fkliuyan">
								给我留言
							</a>
						</div>

					</div>
				</section>

				<section class="footer-bd">
					<div class="bd">
						<div class="title">
							<a href="#top" class="logo"></a>
							一个前端工程师的个人网站
						</div>
						<ul class="inner clearfix">
							<li class="column">
								<a href="javascript:void(0);">
									<span class="icon icon-about-me">&#xe60e;</span>
								</a>

								<span class="desc text">联系我</span>
								<div class="links">
									<a href="javascript:void(0);" class="link text">
										TEL:15649032317
									</a>
									<a href="javascript:void(0);" class="link text">
										QQ:55644146
									</a>
									<a href="" class="link text">

									</a>
								</div>
							</li>
							<li class="column">
								<a href="javascript:void(0);">
									<span class="icon icon-wx">&#xe607;</span>
								</a>

								<span class="desc text">微信</span>
								<div class="pic pic1">

								</div>
							</li>
							<li class="column">
								<a href="javascript:void(0);">
									<span class="icon icon-qq">&#xe608;</span>
								</a>

								<span class="desc text">微博</span>
								<a class="wbpic" href="http://weibo.com/u/2986295253?refer_flag=1001030102_" target="_blank">
									<div class="pic pic2">

									</div>
								</a>
							</li>
							<li class="column">

								<a href="javascript:void(0);">
									<span class="icon icon-share">&#xe60b;</span>
								</a>

								<span class="desc text">分享到</span>

								<div class="link-share text">
									<a target="_blank" class="icon-qq" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=http://www.jzyhn.com/v.php&title=V-mx主页">
										<span class="icon icon-qq">&#xe605;</span>
									</a>
									<a target="_blank" class="icon-wx" href="http://connect.qq.com/widget/shareqq/index.html?url=http://www.jzyhn.com/v.php&title=V-mx主页">
										<span class="icon icon-wx">&#xe604;</span>
									</a>
									<a target="_blank" class="icon-xl" href="http://v.t.sina.com.cn/share/share.php?url=http://www.jzyhn.com/v.php&title=V-mx主页">
										<span class="icon icon-xl">&#xe608;</span>
									</a>
								</div>
							</li>
						</ul>

						<div class="copyright">

							Copyright &copy; 2016 作者：DuYang. 前端工程师

						</div>
					</div>
				</section>
			</footer>
		</div>
		<!--js-->

		<script type="text/javascript" src="Vmxindex/js/index.js"></script>
		<script type="text/javascript">//轮播

//header动画
//hAni();
//随机数
function getRandom(min, max) {
	return Math.round(Math.random() * (max - min) + min);
}

function hAni() {

	$(".bg").on("mouseenter", function() {
		$(".flys-ani").addClass("animated rotateInUpRight");

	})
	$(".bg").on("mouseleave", function() {
		$(".flys-ani").removeClass("animated rotateInUpRight");

	})

	$(".h-ani1").on("mouseenter", function() {
		$(".h-ani1 .slogan").addClass("animated tada ");

	});
	$(".h-ani1").on("mouseleave", function() {
		$(".h-ani1 .slogan").removeClass("animated tada ");

	});
	$(".h-ani2").on("mouseenter", function() {
		$(".h-ani2 .slogan").addClass("animated jello ");
	});
	$(".h-ani2").on("mouseleave", function() {
		$(".h-ani2 .slogan").removeClass("animated jello ");
	});
	$(".h-ani3").on("mouseenter", function() {
		$(".h-ani3 .slogan").addClass("animated rubberBand ");
	});
	$(".h-ani3").on("mouseleave", function() {
		$(".h-ani3 .slogan").removeClass("animated rubberBand ");
	});
}
//滑块消失

$(".nav").on("mouseleave", function() {
		$(".nav-fly").stop().animate({
			width: 0
		}, 300)
	})
	//滑块移动
$(".nav a").on("mouseenter", function() {

		$index2 = $(this).index();
		if($index2 > 4) {
			return
		}
		//上一个的宽
		$width = parseInt($(".nav a").eq($index2).css("width"));

		$left = $(this).position().left + 20;
		$(".nav-fly").stop().animate({
			width: $(this).css("width"),
			left: $left + "px"
		}, 300)
	})
//正在建设提示
$(".nav a").on("click", function() {
		$index3 = $(this).index();
		if($index3 == 4) {
			$(".reminder2").css("color", "aqua");
		$(".reminder2").html("成长中...");
		reminderbox2();

		}

	})

$("#flyss").on("click", function() {
	$(".reminder2").css("color", "aqua");
		$(".reminder2").html("成长中...");
		reminderbox2();
})
	//监视页面上边距
$(window).on("scroll", function() {
		//	console.log($("body").scrollTop());
		var bodyST = parseInt($("body").scrollTop());
		var a = 0,
			n = 200;

		if(bodyST < (($("#a").offset().top) - n)) {
			a = 0;
		}
		if(bodyST >= (($("#a").offset().top) - n)) {
			a = 1;
		}
		if(bodyST >= (($("#b").offset().top) - n)) {
			a = 2;
		}
		if(bodyST >= (($("#c").offset().top) - n)) {
			a = 3;
		}
		if(bodyST >= (($("#d").offset().top) - n)) {
			a = 4;
		}
		if(bodyST >= (($("#e").offset().top) - n)) {
			a = 5;
		}
		if(bodyST >= (($("#f").offset().top) - n)) {
			a = 6;
		}

		if(bodyST >= (($("#footer").offset().top) - 500)) {
			a = 7;
		}

		$(".click-menu .menus .menu i").removeClass("active");

		$(".click-menu .menus .menu i").eq(a).addClass("active");

	})
	//留言板展示随机位置

$(".Message-show").on("mouseenter", function() {
	liuyanshowbox();
})

liuyanshowbox();

function liuyanshowbox() {
	for(var i = 0; i < 4; i++) {
		$(".pic-show-box")[i].style.left = getRandom(-100, 400) + "px";
		$(".pic-show-box")[i].style.top = getRandom(-50, 300) + "px";
		$(".pic-show-box")[i].style.transform = "rotate(" + getRandom(0, 360) + "deg)";
	}
	for(var i = 4; i < 8; i++) {
		$(".pic-show-box")[i].style.left = getRandom(450, 800) + "px";
		$(".pic-show-box")[i].style.top = getRandom(-50, 300) + "px";
		$(".pic-show-box")[i].style.transform = "rotate(" + getRandom(0, 360) + "deg)";
	}
}</script>
		<!--登录动态-->
		<script type="text/javascript" src="Vmxindex/js/login.js"></script>
		<!---->
		<script type="text/javascript" src="Vmxindex/js/pengzhuang.js">

		</script>
		<!--主页的访客留言，不需要登录-->
		<script type="text/javascript">//点击留言按钮

$(".fkliuyan").on("click", function() {

	//弹出留言框
	$(".liuyan-box").css("display", "block");

	$(".liuyan-box").removeClass("animated bounceOutUp");

	$(".liuyan-box").addClass("animated bounceInDown");

})

//留言框打开关闭
//关闭登录页
$(".liuyan-close").on("mouseenter", function() {
	$(".liuyan-close").css({
		color: "red"
	})
	$(".liuyan-close").addClass("animated flash");

})

$(".liuyan-close").on("mouseleave", function() {
	$(".liuyan-close").css({
		color: "#ffffff"
	})
	$(".liuyan-close").removeClass("animated flash")

})

$(".liuyan-close").on("click", function() {

	$(".liuyan-box").addClass("animated bounceOutUp ")
})

$(".liuyan-btn").on("click", function() {
	if($("#liuyan-name").val() == "" || $("#liuyan-c").val() == "") {
		//		alert("请填写完整的信息");
		$(".reminder2").css("color", "aqua");
		$(".reminder2").html("请填写完整的信息~");
		reminderbox2();
	} else {
		//提交留言
		$.ajax({

			type: "post",
			url: "Vmxindex/php/fkliuyan.php",
			async: true,
			data: {
				ip: $("#ips").val(),
				c: $("#liuyan-c").val(),
				t: $("#liuyan-name").val(),
				a: 1
			},
			dataType: "json",
			success: mainLy2,
			error: errorsLy2
		});
	}

})

function mainLy2(data) {
	//	$(".reminder").html(data.msg);
	if(data.color) {
		$(".reminder2").css("color", data.color);
	}
	//关闭留言板，清除内容
	if(data.msg == 1) {
		$(".reminder2").html("提交成功，谢谢~");
		$(".reminder-wrap").slideDown("normal");
		setTimeout(function() {
			$(".reminder-wrap").slideUp("normal");
			$("#liuyan-c").val("");
			$("#liuyan-name").val("");
			$(".liuyan-box").addClass("animated bounceOutUp ");

		}, 1200)
	} else {
		$(".reminder2").html("数据库读取错误，请重试~");
		reminderbox2();
	}

}

function errorsLy2(data) {
	$(".reminder2").css("color", "pink");
	$(".reminder2").html("服务器无响应，请重试~");
	console.log(data);
	reminderbox2();

}

function reminderbox2() {
	$(".reminder-wrap").slideDown("normal");
	setTimeout(function() {
		$(".reminder-wrap").slideUp("normal");
	}, 1200)
}</script>
		<script type="text/javascript" src="Vmxindex/game/sssss/js/indexsss.js">

		</script>
	</body>
</html>

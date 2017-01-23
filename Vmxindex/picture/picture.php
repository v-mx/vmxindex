<?php
include_once "../php/link-user.php";

    session_start();

    
    
    //获取访客ip
//  上线之后打开，
$ip = $_SERVER["REMOTE_ADDR"];
 
    
    $times1 = time();
    $times2=date('Y-m-d H:i:s',"$times1");
//  echo $times2;
    //读取，没有就新建
    $query = "select * from picturefangke";
    $result = mysql_query($query);
    
    if(mysql_num_rows($result)>0){
        //读取id1的数据
        $query = "select * from picturefangke where id = 1";
        $result = mysql_query($query);
        if(mysql_num_rows($result) == 1){
            $row = mysql_fetch_assoc($result);
            $num=$row["num"]+1;
            $query = "update picturefangke set num = '$num' where id=1";
            mysql_query($query);
            
//          echo $num."访问量";
            //写入时间
            $query = "insert into picturefangketime(times,fangkenum,ip) values('$times2','$num','$ip')";
            mysql_query($query);
            if(mysql_affected_rows()==1){
//              echo "添加时间成功";
            }else{
//              echo "操作时间失败";
            }

        }
    }else{
        //新建一条数据
        $query = "insert into picturefangke(num) values(0)";
        
        mysql_query($query);
        if(mysql_affected_rows()==1){
//          echo "添加成功";
        }else{
//          echo "操作失败";
        }
    }   
    
    
    
    
?>
<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8" />
        <title>V-mx贴图日志</title>
        <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">

        <link rel="stylesheet" type="text/css" href="../css/index-all.css"/>
        <link rel="stylesheet" type="text/css" href="../css/index.css"/>
        <link rel="stylesheet" type="text/css" href="../css/animate-all.css"/>
        <link rel="stylesheet" type="text/css" href="../css/animate.css"/>
        <link rel="stylesheet" type="text/css" href="css/picture.css"/>
        <!--图片墙-->
        <link rel="stylesheet" type="text/css" href="css/index.css"/>
    </head>
    <body>
        <div class="big-box" id="top">
            <!--header-->
            <header class="index">

               
                <!--首页的添加信息-->
                <div class="inner">
                    
                    <!-- 导航列表公用!!!!!!!!!!!!!!!!!!!!!! -->
                    <div class="nav-wrapper clearfix">
                        <div class="logo animated infinite bounce">

                        </div>
                        <nav class="nav">
                            <a href="../../v.php">
                                首页
                            </a>
                            <a href="../Zresume/index.html" target="_blank">
                                我的简历
                            </a>
                            <a href="javascript:void(0);"  class="active">
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
                    

                </div>
            </header>
            <!--==========注册悬浮框===============-->
            <div class="wrap-login forwards">
                <!--存储id-->
        <input type="hidden" name="" id="ids" value="<?php 
                if(isset($_SESSION["Vmxid"])){
                    echo $_SESSION["Vmxid"];  
                }else{
                    echo "nologin";     
                }
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
                        <h3>快速注册</h3>

                        <p>
                            <input type="text" name="name" class="intext" id="name2" maxlength="12" value="" onchange="ajaxPostY()" placeholder="用户名（注册）"/>
                        </p>
                        <p>
                            <input type="password" name="pass" class="intext" id="pass2" maxlength="12" value="" placeholder="密码（注册）"/>
                        </p>
                        <!--验证码-->
                        <!--验证码-->
						<div class="code-box">
								<img src="../php/code.php" class="code-img"/>
								<input type="text" name="content" maxlength="4" id="code-content" value="" placeholder="输入验证码"/>
								<span>看不清？点击验证码更换</span>
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
                  
                        
                        <div class="times-box">
                            
                            <span id="times"></span>
                        </div>

                    </div>

                </div>
            </section>
            <!--返回顶部-->
            <div class="go-top">
                <span>&#xe603;</span>
            </div>
			<!--图片墙部分-->
			<section class="picture">
				<div class="wrap" id="wrap">
		<!-- 下面是一个框的整体 -->
			<!--<div class="photo photo_front">    
				<div class="photo_wrap">    
					<div class="side side-front">  
						<p class="image" style="background-image: url();background-size: cover;background-position: center;">
							
						</p>
						<p class="caption">哈哈</p>
					</div>
					<div class="side side-back">  
						<p class="desc">无数据</p>
					</div>					
				</div>				
			</div>-->
			
			<!--按钮-->
			<!--<div class="nav"> 
				<span class="button current">&#xe600;</span>
				<span class="button current">&#xe600;</span>
			</div>-->
				</div>
				<!--加载下一页日志-->
				<div class="change-pages">
					<p><span id="f-page"></span>&nbsp;/&nbsp;<span id="a-page"></span></p>
					<div class="page-box">
						<a href="javascript:void(0);" class="prev2"><span id="">
						&#xe614;
					</span></a>
					<a href="javascript:void(0);" class="next2"><span id="">
						&#xe615;
					</span></a>
					<a href="javascript:void(0);" class="mag"><span id="">
						&#xe613;
					</span></a>
					</div>
					<!--发布贴图日志-->
					<a href="javascript:void(0);" id="addlog">
						发布贴图日志
					</a>
					
				</div>
				
				
				
				
				
			</section>
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
                	<textarea name="liuyan-c" rows="" cols="" id="liuyan-c" maxlength="300" placeholder="请输入留言内容"></textarea>
                	
                	
                	 <!--提交-->
                <button class="liuyan-btn">提交评论</button>
                
                
                
                </div>
               
				
			</section>
            

            <!--底部公用-->
            <footer>
                <section class="register-wrapper">
                    <div class="bd">
                        <div class="buttons">
                            <a href="javascript:void(0);" class="btn open personal logons">
                                快速注册
                            </a>
                            <a href="javascript:void(0);" class="btn open org logins fkliuyan">
                                登录评论
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
                                <a target="_blank" class="icon-qq" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=http://www.jzyhn.com/index.html&title=V-mx主页">
                                    <span class="icon icon-qq">&#xe605;</span>
                                </a>
                                <a target="_blank" class="icon-wx" href="http://connect.qq.com/widget/shareqq/index.html?url=http://www.jzyhn.com/index.html&title=V-mx主页">
                                    <span class="icon icon-wx">&#xe604;</span>
                                </a>
                                <a target="_blank" class="icon-xl" href="http://v.t.sina.com.cn/share/share.php?url=http://www.jzyhn.com/index.html&title=V-mx主页">
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
        <script src="../js/jquery-1.8.3.min.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript" src="../js/index.js"></script>
        <script type="text/javascript">//轮播
$index = 0;
//下标切换
$(".dots").on("mouseenter", function() {

    $index = $(this).index();
    clearInterval($time);
    moves();
})



function moves() {
    //删除
    $(".h-ani1 .slogan").removeClass("animated tada ");
    $(".h-ani2 .slogan").removeClass("animated jello ");
    $(".h-ani3 .slogan").removeClass("animated rubberBand ");
    $(".flys-ani").removeClass("animated rotateInUpRight");

    $(".index-lunbo").stop().animate({
        left: -($index + 1) * 100 + "%"
    }, 400, function() {
        if($index == 3) {
            $index = 0;
        }
        $(".index-lunbo").css({
            left: -($index + 1) * 100 + "%"
        })
        $(".dots .dot").removeClass("active");
        $(".dots .dot").eq($index).addClass("active");

    })

    $(".h-ani1 .slogan").addClass("animated tada ");
    $(".h-ani2 .slogan").addClass("animated jello ");
    $(".h-ani3 .slogan").addClass("animated rubberBand ");
    $(".flys-ani").addClass("animated rotateInUpRight");

    timemove();
}
timemove();

function timemove() {
    $time = setInterval(function() {
        clearInterval($time);
        $index++;
        moves();
    }, 4000)
}
//自适应轮播图,最小1900
window.onresize = function() {
        $winw = window.innerWidth;

        if($winw > 1900) {
            $(".index-lunbo .bg").css({
                width: $winw + "px"
            });
            $(".lunbo-wrap2").css({
                width: $winw + "px",
                left: -(($winw - 1900) / 2 + 410) + "px"
            });
            $(".index-lunbo").css({
                width: 4 * $winw + "px"
            })

        } else if($winw < 1900) {
            $(".index-lunbo .bg").css({
                width: "1900px"
            });
            $(".lunbo-wrap2").css({
                width: 1900 + "px",
                left: -410 + "px"
            });
            $(".index-lunbo").css({
                width: 7600 + "px"
            })
        }
    }
    //header动画
hAni();

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
        }, 400)
    })
//正在建设提示
$(".nav a").on("click", function() {
    $index3 = $(this).index();
    if($index3 == 4) {
        alert("正在建设中");
        
    }
    
})



</script>
<!--登录-->
<script type="text/javascript" src="../js/fen-login.js">
	
</script>
<!--图片墙-->

	
</script>
<script type="text/javascript" src="js/pictureBox.js">
	
</script>
    </body>
</html>

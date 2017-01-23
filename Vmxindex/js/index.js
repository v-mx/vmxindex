console.log("我是杜渠，一名前端工程师,对前端和编程技术非常热爱，做过很多技术方面的东西，对我有意向的公司和猎头可以QQ联系我或者给我发邮件，谢谢！");

$indexl = 0;
//下标切换
$(".dots").on("mouseenter", function() {

	$indexl = $(this).index();
	$(".dots .dot").removeClass("active");
	if($indexl == 3) {
		$i = 0;
	} else {
		$i = $indexl;
	}
	$(".dots .dot").eq($i).addClass("active");
	clearInterval($time);
	moves();
})

function moves() {
	//删除
	$(".h-ani1 .slogan").removeClass("animated tada ");
	$(".h-ani2 .slogan").removeClass("animated jello ");
	$(".h-ani3 .slogan").removeClass("animated rubberBand ");
	$(".flys-ani").removeClass("animated rotateInUpRight");

	$(".dots .dot").removeClass("active");
	if($indexl == 3) {
		$i = 0;
	} else {
		$i = $indexl;
	}
	$(".dots .dot").eq($i).addClass("active");

	$(".index-lunbo").stop().animate({
		left: -($indexl + 1) * 100 + "%"
	}, 700, function() {
		if($indexl >= 3) {
			$indexl = 0;
		}

		$(".index-lunbo").css({
			left: -($indexl + 1) * 100 + "%"
		})
		$(".dots .dot").removeClass("active");
		$(".dots .dot").eq($indexl).addClass("active");

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
		$indexl++;
		moves();
	}, 4000)
}

//自适应轮播图,最小1900
//window.onresize = function() {
//		$winw = window.innerWidth;
//
//		if($winw > 1900) {
//			$(".index-lunbo .bg").css({
//				width: $winw + "px"
//			});
//			$(".lunbo-wrap2").css({
//				width: $winw + "px",
//				left: -(($winw - 1900) / 2 + 410) + "px"
//			});
//			$(".index-lunbo").css({
//				width: 4 * $winw + "px"
//			})
//
//		} else if($winw < 1900) {
//			$(".index-lunbo .bg").css({
//				width: "1900px"
//			});
//			$(".lunbo-wrap2").css({
//				width: 1900 + "px",
//				left: -410 + "px"
//			});
//			$(".index-lunbo").css({
//				width: 9500 + "px"
//			})
//		}
//	}
//logo彩蛋
$(".logo").on("mouseenter", function() {

	$(".logo").removeClass("animated infinite bounce");
	$(".logo").addClass("animated  hinge");
	setTimeout(function() {
		$(".logo").removeClass("animated  hinge");

		$(".logo").addClass("animated infinite bounce");

	}, 5000)

})

//倒计时
var times = document.getElementById("times");
var timesC = 0;
setInterval(function() {
		timesC++;
		var nowTime = new Date().getTime();
		var tarTime = new Date(2021, 5, 2).getTime();
		var disTime = Math.round((tarTime - nowTime) / 1000 - 8 * 3600);
		var seconds = addZero(disTime % 60);
		var minutes = addZero((disTime - seconds) / 60 % 60);
		var hours = addZero((disTime - minutes * 60 - seconds) / 3600 % 24);
		var day = addZero((disTime - hours * 3600 - minutes * 60 - seconds) / 86400);

		times.innerHTML = day + " 天 " + hours + " 时 " + minutes + " 分 " + seconds + " 秒 ";
		if(timesC > 30) {
			timesC = 0;
			//			times.style.color = "rgba(" + getRandom(0, 255) + "," + getRandom(0, 255) + "," + getRandom(0, 255) + ",1)";
		}
	}, 50)
	//补两位函数
function addZero(n) {
	if(n < 10) {
		return n = "0" + n;
	} else {
		return n = n + "";
	}
}

//随机数
function getRandom(min, max) {
	return Math.round(Math.random() * (max - min) + min);
}

//pz end
//进度条监视事件
var gotop = false;
$(window).scroll(function() {

	if(document.body.scrollTop > 500) {
		//手机端处理
		if(gotop) {
			$(".go-top").removeClass("animated bounceOutUp");
		}

		$(".go-top").css({
			"display": "block",
			"color": "#00b6e3"
		})

		$(".go-top").stop().animate({
			"opacity": "1"
		}, 400)
	}
	if(document.body.scrollTop < 500) {
		$(".go-top").css("display", "none")

		$(".go-top").stop().animate({

			"opacity": "0"
		}, 400)
		gotop = true;
	}

});

$(".go-top").on("click", function() {
	gotop = false;
	$(".go-top").removeClass("animated flash");

	setTimeout(function() {
		$("body").animate({
			scrollTop: 0
		}, 400)
	}, 400)

	$(".go-top").addClass("animated bounceOutUp");

})
$(".go-top").on("mouseenter", function() {
	$(".go-top").removeClass("animated bounceOutUp");

	$(".go-top").addClass("animated flash");
	$(".go-top").css({
		color: "#ff8833"
	})
})
$(".go-top").on("mouseleave", function() {
	$(".go-top").removeClass("animated flash");

	$(".go-top").css({
		color: "#00b6e3"
	})
})

//css动画轮播

$("#cssshow-box").on("mouseenter", function() {
	$(".change-page").css({
		opacity: 1

	})
})
$("#cssshow-box").on("mouseleave", function() {
	$(".change-page").css({
		opacity: 0

	})
})

var cssindex = 0;
$move = false;
$('.prev').on("click", function() {
	if($move) {
		return;
	}
	$move = true;
	cssindex--;
	cssmoves();
})

$('.next').on("click", function() {
	if($move) {
		return;
	}
	$move = true;
	cssindex++;
	cssmoves();
})

function cssmoves() {

	$(".page-move").stop().animate({
		left: -(cssindex + 1) * 1000 + "px"
	}, 400, function() {
		if(cssindex == 3) {
			cssindex = 0;
		}
		if(cssindex == -1) {
			cssindex = 2;
		}
		$(".page-move").css({
			left: -(cssindex + 1) * 1000 + "px"
		})
		$move = false
	})
}

//右侧点击菜单

$(".click-menu .menus .menu").on("click", function() {

	$target = $(this).index();
	$(".click-menu .menus .menu i").removeClass("active");

	$(".click-menu .menus .menu i").eq($target).addClass("active");
	var target = ["#top", "#a", "#b", "#c", "#d", "#e", "#f", "#footer"];

	if(target[$target] == "#top" || target[$target] == "#footer" || target[$target] == "#f") {
		$('html,body').animate({
			scrollTop: $(target[$target]).offset().top
		}, 900);
	} else {
		$('html,body').animate({
			scrollTop: $(target[$target]).offset().top + 130
		}, 900);
	}

})

//V-mx效果

$("#flyss").on("mouseenter", function() {
	$("#flyss").addClass("animated rubberBand");
})
$("#flyss").on("mouseleave", function() {
	$("#flyss").removeClass("animated rubberBand");

})

//轮播图鼠标位置信息
//
$(".index").on("mousemove", function(e) {
	clearInterval($time);

	var e = e || window.event;
	//获取展开的宽度
	$hw = parseInt($(".index").css("width"));
	$hh = parseInt($(".index").css("height"));

	//鼠标位于轮播的中心点位置
	$mx = $hw / 2;
	$my = $hh / 2;
	//鼠标位于page 的坐标
	$mpx = e.pageX;
	$mpy = e.pageY;
	//鼠标相对于中心点的位移
	$mxx = $mpx - $mx;
	$mxy = $mpy - $my;

	//开始运动
	//背景图
	//	top: -30%;
	//  left: 40%;
	$(".flys-ani").css({
		left: 40 - $mxx / 200 + "%",
		top: -30 - $mxy / 100 + "%",
		"-webkit-transition": "all 0s",
		transition: "all 0s"

	})
	$(".slogan").css({
		left: $mxx / 30 + "px",
		top: $mxy / 15 + "px",
		"-webkit-transition": "all 0s",
		transition: "all 0s"
	})
	$(".version").css({
		left: -$mxx / 20 + "px",
		top: $mxy / 10 + "px",
		"-webkit-transition": "all 0s",
		transition: "all 0s"
	})

})

//恢复原位,有好多的inner类名，必须选准了
$(".index .inner").on("mouseleave", function() {
	clearInterval($time);
	timemove();
	$(".flys-ani").css({
		left: 40 + "%",
		top: -30 + "%",
		"-webkit-transition": "all 0.5s",
		transition: "all 0.5s"
	})

	$(".slogan").css({
		left: 0,
		top: 0,
		"-webkit-transition": "all 0.5s",
		transition: "all 0.5s"
	})
	$(".version").css({
		left: 0,
		top: 0,
		"-webkit-transition": "all 0.5s",
		transition: "all 0.5s"
	})

})


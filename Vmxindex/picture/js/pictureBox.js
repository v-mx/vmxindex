//动态创建标签 直接在innerhtml中写入 
//随机选择一个图片居中显示 其他图片散列排放
//按钮图片相关联

//通用函数，传进去参数用来判断是class还是id		
function g(selector) {
	return selector.substring(0, 1) == "." ? document.getElementsByClassName(selector.substring(1)) : document.getElementById(selector.substring(1));
}
//		console.log(g(".wrap"));
//随机函数
function getRandom(min, max) {
	return Math.round(Math.random() * (max - min) + min);
}

function turn(elem) {
	var cls = elem.className;
	for(i = 0; i < datalength; i++) {
		if(elem == g(".photo")[i]) {
			break;
		}
	}

	if(!/photo_center/.test(cls)) {
		//if(cls.search("photo_center")==-1){
		return sort(i);
	}
	//console.log(cls.search("photo_center"));			
	if(/photo_front/.test(cls)) {
		//if(cls.search("photo_front")>=0){				
		cls = cls.replace(/photo_front/, 'photo_back');
		g(".button")[i].className += " back";
	} else {
		cls = cls.replace(/photo_back/, 'photo_front');
		g(".button")[i].className = g(".button")[i].className.replace(/\s*back\s*/, ' ');;
	}

	elem.className = cls;
}
// 动态添加图片
//当前的页码
var pagepic = 0;
//总共页码
var pagenum = 0;

function addPhotos() {

	//ajax获取
	$.ajax({
		type: "post",
		url: "../php/radepic.php",
		async: true,
		data: {
			page: pagepic
		},
		dataType: "json",
		success: mainR2,
		error: errorsR2
	});

}
addPhotos();
//ajax
var html = ""; //存放图片
var nav = ""; //存放按钮
var data = 0;
var datalength = 0;

function mainR2(data2) {
	html = ""; //存放图片
	nav = ""; //存放按钮
	datalength = data2.length - 1;
	pagenum = data2[data2.length - 1];
	//写入页码
	$("#f-page").html(pagepic+1);
	$("#a-page").html(pagenum);
	
	for(i = 0; i < data2.length - 1; i++) {
		//获取的标题
		var datacaption = data2[i].title;
		//获取的图片
		var dataimg = data2[i].img;
		//获取的内容
		var datadesc = data2[i].c;
		//获取时间
		var datatime = data2[i].time2;
		var colors = data2[i].color;

		html += '<div class="photo photo_front"><div class="photo_wrap" style="border:20px ' + colors + ' solid;"><div class="side side-front" ><p class="image" style="background-image: url(' + dataimg + ');background-size: cover;background-position: center;"></p><p class="caption">' + datacaption + '&nbsp;&nbsp;' + '<i style="font-size:12px;color:#c5c5c5;">' + datatime  + '</i>' + '</p></div><div class="side side-back"><p class="desc">' + datadesc + '</p></div>	</div></div>';
		nav += '<span class="button current">&#xe616;</span>';
	}
	var navigation = '<div class="nav2">' + nav + '</div>';
	g("#wrap").innerHTML = html + navigation;

	sort(getRandom(0, datalength - 1));

	//按钮绑定事件
	for(i = 0; i < datalength; i++) {
		(function(i) {
			g(".button")[i].onclick = function() {
				turn(g(".photo")[i]);
			}
			g(".photo")[i].onclick = function() {
				turn(this);
			}
		})(i);
	}

}

function errorsR2(data2) {
	$(".reminder2").css("color", "orange");
	$(".reminder2").html("请求数据库失败，请重试");
	reminderbox();
}

//图片随机排序

function sort(n) {
	//n为随机选出默认放在正中间位置的图片
	var photo = g(".photo");
	var photos = [];
	var wrapWid = parseInt(getComputedStyle(g("#wrap"), "").width);
	var wrapHeight = parseInt(getComputedStyle(g("#wrap"), "").height);
	var photoWid = parseInt(getComputedStyle(g(".photo")[0], "").width);
	var photoHeight = parseInt(getComputedStyle(g(".photo")[0], "").height);
	//console.log(wrapWid,wrapHeight,photoWid,photoHeight);
	for(var i = 0; i < photo.length; i++) {
		photo[i].className = "photo photo_front";
		photo[i].style.left = "";
		photo[i].style.top = "";

		photos.push(photo[i]);
	}

	var photo_center = g(".photo")[n];
	photo_center.className += " photo_center";
	photo_center.style.transform = "scale(1.3) rotate(0deg)";
	photo_center = photos.splice(n, 1);

	var photo_left = photos.splice(0, Math.round(photos.length / 2));
	var photo_right = photos;

	//			console.log(photo_left.length,photo_right.length);
	//			左边元素分区
	for(var i = 0; i < photo_left.length; i++) {
		photo_left[i].style.left = getRandom(-photoWid / 2, wrapWid / 2 - photoWid / 2 * 3) + "px";
		photo_left[i].style.top = getRandom(-photoHeight / 2, wrapHeight) + "px";
		photo_left[i].style.transform = "rotate(" + getRandom(0, 360) + "deg)";
	}

	for(var i = 0; i < photo_right.length; i++) {
		photo_right[i].style.left = getRandom(wrapWid / 2 + photoWid / 2, wrapWid + photoWid / 2) + "px";
		photo_right[i].style.top = getRandom(-photoHeight / 2, wrapHeight) + "px";
		photo_right[i].style.transform = "rotate(" + getRandom(0, 360) + "deg)";
	}

	//控制按钮
	var navs = g('.button');
	for(var k = 0; k < navs.length; k++) {
		navs[k].className = 'button current';
	}
	navs[n].className += ' active';
	pagecolor();
}

//点击上一页和下一页重新请求然后加载

// 动态添加图片
//var pagepic = 0;

//上一页，下一页

$(".prev2").on("click", function() {
	pagepic--;
	pagepic = pagepic <= 0 ? 0 : pagepic
	pagecolor();

	addPhotos();
})

$(".next2").on("click", function() {
	pagepic++;
	pagepic = pagepic >= (pagenum - 1) ? pagenum - 1 : pagepic
	pagecolor();

	addPhotos();
})

//

//页码最后一页和第一页测试
function pagecolor() {
	$(".prev2").css({
		"background": "#8aba56"
	})
	$(".next2").css({
		"background": "#8aba56"
	})

	if(pagepic == 0) {
		$(".prev2").css({
			"background": "#aaa"
		})

	} 
	
	if(pagepic == (pagenum - 1)) {
		$(".next2").css({
			"background": "#aaa"
		})
	}
}

//点击留言按钮，检测是否已经登录

$(".mag").on("click", function() {
	var ids = $("#ids").val();
	if(ids != "nologin") {
		//alert("已登录");
		//弹出留言框
		$(".liuyan-box").css("display", "block");

		$(".liuyan-box").removeClass("animated bounceOutUp");

		$(".liuyan-box").addClass("animated bounceInDown");

	} else {
		$(".reminder2").css("color", "aqua");
	$(".reminder2").html("评论贴图墙需要登录~");
	reminderbox();
	}
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
		alert("请填写完整的信息");
	} else {
		//		提交留言
		$.ajax({

			type: "post",
			url: "../php/liuyan.php",
			async: true,
			data: {
				user: $("#ids").val(),
				c: $("#liuyan-c").val(),
				t: $("#liuyan-name").val(),
				a: 1
			},
			dataType: "json",
			success: mainLy,
			error: errorsLy
		});
	}

})

function mainLy(data) {
	//	$(".reminder").html(data.msg);
	if(data.color) {
		$(".reminder2").css("color", data.color);
	}
	//关闭留言板，清除内容
	if(data.msg == 1){
	$(".reminder2").html("提交成功，谢谢~");
	$(".reminder-wrap").slideDown("slow");
	setTimeout(function() {
		$(".reminder-wrap").slideUp("slow");
		$("#liuyan-c").val("");
		$("#liuyan-name").val("");
		$(".liuyan-box").addClass("animated bounceOutUp ");

	}, 1200)
	}else{
		$(".reminder2").html("数据库错误，请重试~");
		reminderbox();
	}

}

function errorsLy(data) {
	$(".reminders2").css("color", "red");
	$(".reminders2").html("服务器无响应，请重试~");
	reminderbox();

}

function reminderbox() {
	$(".reminder-wrap").slideDown("slow");
	setTimeout(function() {
		$(".reminder-wrap").slideUp("slow");
	}, 1200)
}

//发布日志的后台验证之后在后台跳转
$("#addlog").on("click",function(){
	$.ajax({
			type: "post",
			url: "../php/liuyan.php",
			async: true,
			data: {
				user: $("#ids").val(),
				a: 2
			},
			dataType: "json",
			success: mainLf,
			error: errorsLf
		});
})

function mainLf(data) {
	if(data.msg == 0){
		$(".reminder2").css("color", "#ffffff");
	$(".reminder2").html("仅站长登录权限");

	}else{
	//刷新页面重新加载
	window.location.href = "../php/gotonew.php";
	
	}
	reminderbox();
	
}

function errorsLf(data) {
	$(".reminder2").css("color", "orange");
	$(".reminder2").html("服务器无响应，请重试~");
	reminderbox();

}

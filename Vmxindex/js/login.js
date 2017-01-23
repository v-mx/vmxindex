//这是登录用的js

//关闭登录页
$(".login-close").on("mouseenter", function() {
	$(".login-close span").css({
		color: "orange"
	})
	$(".login-close").addClass("animated flash");

})
$(".login-close").on("mouseleave", function() {
	$(".login-close span").css({
		color: "#ffffff"
	})
	$(".login-close").removeClass("animated flash")

})

$(".login-close").on("click", function() {

	$(".wrap-login").addClass("animated bounceOutUp ")
})

//登录打开登录框
$(".open").on("click", function() {
		$(".reminder").css("color", "orange");
		$(".wrap-login").css("display", "block");

		$(".wrap-login").removeClass("animated bounceOutUp");

		$(".wrap-login").addClass("animated bounceInDown");

	})
	//是注册的
$(".logons").on("click", function() {
		$(".reminder").css("color", "orange");
		$("#login-box").slideUp("slow");
		$("#logon-box").slideDown("slow");
		$("#name1").val("");
		$("#pass1").val("");
		//
		$(".user-box").stop().animate({
			height: "400px"
		}, 300);
		$logon = 1;
		$login = 0;
		$(".reminder").html("欢迎注册，请输入昵称和密码");
	})
	//登录时切换的
$(".logins").on("click", function() {
		$("#logon-box").slideUp("slow");
		$("#login-box").slideDown("slow");
		$("#name2").val("");
		$("#pass2").val("");
		$(".user-box").stop().animate({
			"height": "400px"
		}, 300);
		$logon = 0;
		$login = 1;
		$(".reminder").html("欢迎登陆");

	})
	//利用存储的se id判断有没有登录
if($("#ids").val() == "nologin") {
	$(".btn").css({
		"display": "inline-block"
	});
	$("#cancel").css({
		"display": "none",
		"width": "0px"
	})
} else {
	//隐藏登录和注册按钮显示注销按钮
	$(".register-wrapper").slideUp("slow");
	$(".btn").css({
		"display": "none"
	});
	$("#cancel").css({
		"display": "inline-block"
	})
	$("#cancel").animate({
		"width": "300px"
	}, 600)
}
//查找coolkic

//注销登录
$("#cancel").on("click", logouts);

function logouts() {
	$.ajax({
		type: "post",
		url: "Vmxindex/php/login.php",
		async: true,
		data: {
			action: "logout",
		},
		dataType: "json",
		success: logout,
		error: errorslogout
	});
}

function logout(data) {
	console.log(data.msg);
	//注销成功
	//重新绑定登录事件，同时删除注销本身，方式连续点击，绑定多次

	$("#login1").on("click", function() {
		ajaxPostR();
	})
	$(".btn").css({
		"display": "inline-block"
	});
	$("#cancel").css({
		"display": "none",
		"width": "0px"
	})
	$(".register-wrapper").slideDown("slow");

	$("#cancel").unbind();
	$(".reminder").css("color", "orange");
	$(".reminder").html("欢迎~");
	//删除登录框内容，
	$("#name1").val("");
	$("#pass1").val("");
	$("#logout-msg").slideDown("slow");
	$("#logout-msg").html(data.msg);
	setTimeout(function() {
		$("#logout-msg").css("display", "none");
		$("#msg-info").css("display", "none");
		$("#msg-show").css("display", "none");
		$(".article").slideDown("slow");
		$(".usermsg").slideUp("slow");
	}, 1000)
}

function errorslogout(data) {
	$(".reminder").css("color", "red");
	$(".reminder").html("服务器无响应，请重试");
	console.log(data);
}

$logon = 0;
$login = 1;
//登录页面的注册时切换的
$("#logon1").on("click", function() {
		$("#login-box").slideUp("slow");
		$("#logon-box").slideDown("slow");
		$("#name1").val("");
		$("#pass1").val("");
		//
		$(".user-box").stop().animate({
			height: "400px"
		}, 300);
		$logon = 1;
		$login = 0;
		$(".reminder").html("欢迎注册，请输入昵称和密码");

	})
	//注册页面的登录时切换的
$("#login2").on("click", function() {
	$("#logon-box").slideUp("slow");
	$("#login-box").slideDown("slow");
	$("#name2").val("");
	$("#pass2").val("");
	$(".user-box").stop().animate({
		"height": "400px"
	}, 300);
	$logon = 0;
	$login = 1;
	$(".reminder").html("欢迎登陆");

})

//ajax-get，登录时检测用户名是否存在，注册时检测用户名是否有效
function ajaxPostY() {
	if($logon) {
		//注册状态
		$username = $("#name2").val();
		$logB = "logon";
	} else {
		//登录状态
		$username = $("#name1").val();
		$logB = "login";

	}

	$.ajax({

		type: "post",
		url: "Vmxindex/php/login.php",
		async: true,
		data: {
			user: $username,
			action: "yanzheng",
			logB: $logB,
		},
		dataType: "json",
		success: mainY,
		error: errorsY
	});
}

function mainY(data) {
	$(".reminder").html(data.msg);
	if(data.color) {
		$(".reminder").css("color", data.color);
	}
}

function errorsY(data) {
	$(".reminder").css("color", "red");
	$(".reminder").html("服务器无响应，请重试");
	console.log(data);
}

//绑定登录事件,登录成功时删除事件，防止登录成功时被连续点击，此时绑定注销事件
//	$("#logout").on("click",logouts);

$("#login1").on("click", function() {
		ajaxPostR();
	})
	//开始登录或注册

//更换验证码
var codeY = false;
$(".code-img").click(function() {
	$(".reminder").html("请输入图片中的验证码");
	$("#content").val("");
	//重新加载验证码php
	$(this).attr({
		"src": "Vmxindex/php/code.php"
	});
})

function ajaxPostR() {

	if($logon) {
		//正则验证

		//注册状态
		if($("#name2").val() == "" || $("#pass2").val() == "") {
			$(".reminder").css("color", "red");
			$(".reminder").html("请填写完整的用户信息");
			return;
		}

		$username = $("#name2").val();
		$password = $("#pass2").val();

		$logB = "logon";

		
		//验证码检测
		$.ajax({
			type: "get",
			url: "Vmxindex/php/code-ajax.php",
			async: true,
			data: {
				code: $("#code-content").val(),
			},
			success: function(data) {
				if(data == 1) {
					$(".reminder").css("color", "green");
					$(".reminder").html("点击即可注册~");
					codeY = true;

				} else {
					$(".reminder").css("color", "red");
					$(".reminder").html("验证码输入错误，请重新输入");
					codeY = false;
				}

			},
			error: function(data) {
				$(".reminder").html("验证码请求错误，请重试");
				codeY = false;
			}
		});
		
		if(!codeY){
			return;
		}

	} else {
		//登录状态
		if($("#name1").val() == "" || $("#pass1").val() == "") {
			$(".reminder").css("color", "red");
			$(".reminder").html("请填写完整的用户信息");
			return;
		}

		$username = $("#name1").val();
		$password = $("#pass1").val();

		$logB = "login";

	}
	
	

	$.ajax({

		type: "post",
		url: "Vmxindex/php/login.php",
		async: true,
		data: {
			user: $username,
			pass: $password,
			action: "reg",
			logB: $logB,
		},
		dataType: "json",
		success: mainR,
		error: errorsR
	});
}

function mainR(data) {
	console.log(data);

	$(".reminder").html(data.msg);
	if(data.color) {
		$(".reminder").css("color", data.color);
	}
	//登录成功,就隐藏登录模块，显示用户信息模块,同时写入用户名
	if(data.yanzheng == "true") {
		//删除登录事件，防止连续点击
		$("#login1").unbind();
		//隐藏登录和注册按钮显示注销按钮
		$(".btn").slideUp("slow");
		$("#cancel").css({
			"display": "inline-block"
		})
		$("#cancel").animate({
			"width": "300px"
		}, 300)

		$(".register-wrapper").slideUp("slow");

		setTimeout(function() {
			//隐藏登录框
			$(".wrap-login").addClass("animated bounceOutUp ")

			$(".article").slideUp("slow");
			$(".usermsg").slideDown("slow");
			console.log(data.username);
			//第一次登陆页面时使用，之后刷新是在html里用php显示
			$("#usernamemsg").html(data.username);
			$("#msg-show-name").html(data.username);
			//			$("#msg-show-id").html(data.id);
			//$("#infoname").html(data.username);
		}, 500)
	}
}

function errorsR(data) {
	$(".reminder").css("color", "red");
	$(".reminder").html("服务器无响应，请重试");
	console.log(data);
}

//点击变色函数
function clickcolor(_thiss) {
	$(_thiss).css({
		background: "red",
		color: "#ffffff",
	})
	setTimeout(function() {
		$(_thiss).css({
			background: "#ffffff",
			color: "#000000",
		})
	}, 100)
}
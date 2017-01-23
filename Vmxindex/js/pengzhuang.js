//碰撞检测

var wrap = document.querySelector(".wrap-time-pz");
var inner1 = document.querySelector(".inner1-times");
var inner2 = document.querySelector(".inner2-times");

var dir1_l = true; //inner1的left，top方向
var dir1_t = true;
var dir2_l = false; //inner2的left，top方向
var dir2_t = false;
var sss = 60;
var inner1_w = sss,
	inner1_h = sss,
	inner2_w = sss,
	inner2_h = sss,
	wrap_w = 1080,
	wrap_h = 200;

var inner1_l = 0,
	inner1_t = 0,
	inner2_l = 900,
	inner2_t = 150;
var speed1_l = 2,
	speed1_t = 5,
	speed2_l = 4,
	speed2_t = 3;

//测试帧
var fpsBox = document.getElementById("fps");
var f = {
	num:0
};

f.oldTime = new Date();

timesani();


//使用帧
function timesani() {
	
	f.num++;
	f.nowTime = new Date();
	f.dixTime = f.nowTime - f.oldTime;
	f.oldTime = f.nowTime;
	f.n = parseInt(1000/f.dixTime);
	if(f.num>20){
		f.num = 0;
		fpsBox.innerHTML = f.n;
	}
	

	move();
	window.requestAnimationFrame(timesani);
}

//		var timer = setInterval(move,30)

function move() {
	// inner1在容器左右的碰撞
	if(inner1_l <= 0) {
		dir1_l = true;
	} else if(inner1_l >= wrap_w - inner1_w) {
		dir1_l = false;
	}
	// inner2在容器左右的碰撞
	if(inner2_l <= 0) {
		dir2_l = true;
	} else if(inner2_l >= wrap_w - inner2_w) {
		dir2_l = false;
	}
	// inner1在容器上下的碰撞
	if(inner1_t <= 0) {
		dir1_t = true;
	} else if(inner1_t >= wrap_h - inner1_h) {
		dir1_t = false;
	}
	// inner2在容器上下的碰撞

	if(inner2_t <= 0) {
		dir2_t = true;
	} else if(inner2_t >= wrap_h - inner2_h) {
		dir2_t = false;
	}

	// 比较inner1和inner2的left的差值和top的差值
	// 碰撞发生在差值绝对值比较大的方向
	if(Math.abs(inner1_t - inner2_t) < Math.abs(inner1_l - inner2_l)) {
		// 碰撞发生在水平方向上
		// 水平方向上要发生碰撞需满足
		// inner1和inner2的top值差值不超过50
		if(Math.abs(inner1_t - inner2_t) < sss) {
			// inner1在左侧，inner2在右侧
			// left差值不超过50
			// 下面的if可以被优化掉，第一个和第三个if已经有了此效果
			if(inner1_l < inner2_l && inner1_l + sss >= inner2_l) {
				//						clearInterval(timer);
				dir1_l = false;
				dir2_l = true;
			} else if(inner2_l < inner1_l && inner2_l + sss >= inner1_l) {

				dir2_l = false;
				dir1_l = true;
			}
		}
	} else {
		if(Math.abs(inner1_l - inner2_l) < sss) {
			if(inner1_t < inner2_t && inner1_t + sss >= inner2_t) {

				dir1_t = false;
				dir2_t = true;
			} else if(inner2_t < inner1_t && inner2_t + sss >= inner1_t) {

				dir2_t = false;
				dir1_t = true;
			}
		}
	}

	dir1_l ? inner1_l += speed1_l : inner1_l -= speed1_l;
	dir1_t ? inner1_t += speed1_t : inner1_t -= speed1_t;
	dir2_l ? inner2_l += speed2_l : inner2_l -= speed2_l;
	dir2_t ? inner2_t += speed2_t : inner2_t -= speed2_t;
	inner1.style.left = inner1_l + "px";
	inner2.style.left = inner2_l + "px";
	inner1.style.top = inner1_t + "px";
	inner2.style.top = inner2_t + "px";
}

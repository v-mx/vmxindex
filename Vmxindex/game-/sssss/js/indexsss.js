var wraps = document.getElementsByClassName("wrap")[0];
var indexGameSbody = document.getElementsByClassName("sbody")[0];
var indexGamehand = document.getElementsByClassName("hand")[0];
var indexGamefood = document.getElementsByClassName("food")[0]; //食物
var indexGamelis = document.getElementsByClassName("li");
var indexGamefens = document.getElementById("indexGamefens");

wraps.onclick = clickgame;

function clickgame() {
	indexGameSbody.style.opacity = "1";
	indexGamefens.style.zIndex = "0";
	indexGamefens.innerHTML = fen;
	indexGamefens.style.fontSize = "300px";
	indexGamehandMove();
	wraps.onclick = "";
	//-----检测键盘
	document.addEventListener("keydown", keydowning, false);
}

//让头部动起来
//判断方向的标志
var indexGamehandT = false; //ture上false下
var indexGamehandL = false; //ture左false右

//控制定时器频率的
var indexGameseep = 150;

//键盘方向标志
var indexGamehandCt = false; //t被按f没有

var indexGamehandTop = 180,
	indexGamehandLeft = 180; //初始值
var indexGamestime;
//本体和框架的宽高
var indexGamehandW = 30,
	indexGamehandH = 30;
var indexGamewrapW = 900,
	indexGamewrapH = 600;
indexGamehand.style.top = indexGamehandTop + "px";
indexGamehand.style.left = indexGamehandLeft + "px";

//食物闪动
setInterval(function() {
		if(indexGamefood.style.opacity == "1") {
			indexGamefood.style.opacity = "0.3";
		} else {
			indexGamefood.style.opacity = "1";
		}
	}, 600)
	//存储身体各位置数组

//存储位置数组
var indexGamearrL = [];
var indexGamearrT = [];

function indexGamehandMove(e) {

	indexGamestime = setInterval(function() {

		indexGamefoodPingk();
		//-----sbody位置刷新函数,要写在indexGamehand位置获得之前才行
		//不然会重叠，因为是每次头部最后再移动位移就会先跑到前面了
		for(var i = indexGamelis.length - 1; i > 0; i--) {
			indexGamelis[i].style.left = indexGamelis[i - 1].style.left;
			indexGamelis[i].style.top = indexGamelis[i - 1].style.top;
		}
		//判断键盘上上下按键
		if(indexGamehandCt) {

			if(indexGamehandT) {
				if(indexGamehandTop <= 0) { //边缘碰撞检测
					indexGamehandTop = indexGamewrapH - indexGamehandH;
				} else {
					indexGamehandTop -= 30;
				}
			} else {
				if(indexGamehandTop >= (indexGamewrapH - indexGamehandH)) {

					indexGamehandTop = 0;
				} else {
					indexGamehandTop += 30;
				}
			}
			//				console.log(indexGamehandTop);
			indexGamehand.style.top = indexGamehandTop + "px";
		} else {

			if(indexGamehandL) {
				if(indexGamehandLeft <= 0) {
					indexGamehandLeft = indexGamewrapW - indexGamehandW;
				} {
					indexGamehandLeft -= 30;
				}
			} else {
				if(indexGamehandLeft >= (indexGamewrapW - indexGamehandW)) {
					indexGamehandLeft = 0;
				} else {
					indexGamehandLeft += 30;
				}
			}
			//				console.log(indexGamehandLeft);
			indexGamehand.style.left = indexGamehandLeft + "px";
		}

		//存储位置数组
		indexGamearrL = [];
		indexGamearrT = [];
		for(var i = 0; i < indexGamelis.length; i++) {
			indexGamearrL.push(indexGamelis[i].style.left);
			indexGamearrT.push(indexGamelis[i].style.top);
		}

		//是否自杀了
		zisha();

	}, indexGameseep)
}

//判断是否撞到自己的函数
function zisha() {
	//如果数组头部第一个和indexGamearrT、indexGamearrL里其他重复就是是叠加了
	for(var i = 1; i < indexGamearrT.length; i++) {
		if(indexGamearrT[0] == indexGamearrT[i] && indexGamearrL[0] == indexGamearrL[i]) {

			indexGamefens.innerHTML = "游戏结束：" + fen + "分<br/>点击重新开始";
			indexGameSbody.style.zIndex = "0";

			fen = 0;
			indexGamefens.style.fontSize = "50px";
			//				indexGamefens.style.lineHeight = "120px";
			clearInterval(indexGamestime);
			indexGameSbody.style.opacity = "0.2";

			clearInterval(indexGamestime);
			indexGameseep = 150;
			//-----删除检测键盘
			document.removeEventListener("keydown", keydowning, false);
			wraps.onclick = function() {
				//						location.reload();
				

				indexGamefens.innerHTML = "点击开始游戏<br />按Shift加速<br />方向键控制移动</span>"
				indexGameSbody.style.opacity = "1";
				indexGameSbody.style.zIndex = "1";
				indexGamefens.style.zIndex = "0";
				indexGameSbody.innerHTML = '<li class="hand li"></li>';
				wraps.onclick = "";
				wraps.onclick = clickgame;

				indexGamehand = document.getElementsByClassName("index-game")[0].getElementsByClassName("hand")[0];

				indexGamehand.style.top = indexGamehandTop + "px";
				indexGamehand.style.left = indexGamehandLeft + "px";

			}

		}
	}

}

//------随机产生的食物的位置
function getRandom(min, max) {
	return Math.floor(Math.random() * (max - min) + min);
}
//宽度30个，高度20个
function indexGamefoods() {
	//		indexGamefood.style.backgroundColor = "rgba(" + getRandom(0, 255) + "," + getRandom(0, 255) + "," + getRandom(0, 255) + ",1)";
	var indexGamefoodRandomT = getRandom(0, 20);
	var indexGamefoodRandomL = getRandom(0, 30);
	//不把食物在身体上
	for(var i = 0; i < indexGamearrT.length; i++) {
		while((indexGamefoodRandomT == indexGamearrT[i]) && (indexGamefoodRandomL == indexGamearrL[i])) {
			indexGamefoodRandomT = getRandom(0, 20);
			indexGamefoodRandomL = getRandom(0, 30);
			i = 0;
		}
	}

	indexGamefood.style.top = indexGamefoodRandomT * 30 + "px";
	indexGamefood.style.left = indexGamefoodRandomL * 30 + "px";

}
indexGamefoods();
//-----本体碰撞框内检测
function sbodyPingk() {

	//碰到上下检测
	if(indexGamehandTop <= 0) {
		indexGamehandTop = indexGamewrapH - indexGamehandH;
	} else if(indexGamehandTop >= (indexGamewrapH - indexGamehandH)) {

		indexGamehandTop = 0;
	}
	//碰到左右检测
	if(indexGamehandLeft <= 0) {
		indexGamehandLeft = indexGamewrapW - indexGamehandW;
	} else if(indexGamehandLeft >= (indexGamewrapW - indexGamehandW)) {
		indexGamehandLeft = 0;
	}
}
//-----食物碰撞监测
var fen = 0;

function indexGamefoodPingk() {
	var indexGamefoodW = 30,
		indexGamefoodH = 30;
	var indexGamefoodLeft = indexGamefood.offsetLeft;
	var indexGamefoodTop = indexGamefood.offsetTop;
	var indexGamefoodRight = indexGamefoodLeft + indexGamefoodW;
	var indexGamefoodBottom = indexGamefoodTop + indexGamefoodH;
	//碰撞情况,完全重叠
	if(indexGamefoodLeft == indexGamehandLeft && indexGamehandTop == indexGamefoodTop) {
		shuaxin();
	}

}
//刷新的函数
function shuaxin() {
	indexGamefoods();
	indexGamefens.style.fontSize = "50px";
	fen += 1;
	indexGamefens.innerHTML = fen;
	//增加一个
	var newLi = document.createElement("li");
	//添加类名
	newLi.className="li";
	indexGameSbody.appendChild(newLi);

	indexGameSbody.style.opacity = "1";
	indexGamefens.style.zIndex = "0";

	setTimeout(function() {
		indexGamefens.style.fontSize = "300px";

	}, 300)

	if(fen % 11 == 0) {
		indexGameseep -= 40;
		if(indexGameseep < 40) {
			indexGameseep = 60;
		}
	}
}
//-----同样的键值按两次不触发
var TkeyCode = true,
	TkeyOld = 0;

function keydowning(e) {

	var e = e || window.event;
	var keyCode = e.keyCode || e.which;
	e.preventDefault();
	if(TkeyOld == keyCode) {
		TkeyCode = false;
	} else {
		TkeyCode = true;
	}
	if(TkeyCode == true) {
		TkeyOld = keyCode;
		//每次进入重置定时器，重置速度
		clearInterval(indexGamestime);

		//加速
		if(e.shiftKey) {
			e.preventDefault();
			indexGameseep -= 40;
			if(indexGameseep < 40) {
				indexGameseep = 60;
			}
		}
		indexGamehandMove();

		//如果正在向左或右运动，左右键无效,反之同样
		if(indexGamehandCt == false) {
			switch(keyCode) {
				case 40: //下
					//开始运动

					indexGamehandCt = true;
					indexGamehandT = false;
					break;
				case 38: //上

					indexGamehandCt = true;
					indexGamehandT = true;
					break;
			}
		} else {
			switch(keyCode) {
				case 37: //左

					indexGamehandCt = false;
					indexGamehandL = true;
					break;
				case 39: //右

					indexGamehandCt = false;
					indexGamehandL = false;
					break;
			}
		}
	}
}
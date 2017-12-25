(function() {
	'use strict';
	var Rub = function(container, params) {
		var cxt = null;
		var canvas = null;
		var overlay = null;
		//默认属性值
		var defaults = {
			container: container, //canvas的ID
			width: 200, //canvas的宽
			height: 100, //canvas的高
			foreBackgroundColor: "#999", //前景色
			backgroundImage: "../images/example.jpg", //背景图
			fontSize: parseInt(window.getComputedStyle(document.documentElement, null)["font-size"]) * 1.2,
			onRubEnd: null //结束时触发
		};
		var isEnd = false; //判断是否结束
		params = params || {};
		var r = this;
		var originParams = {};
		for(var def in params) {
			originParams[def] = params[def];
		};
		for(var def in defaults) {
			if(typeof params[def] === 'undefined') {
				params[def] = defaults[def];
			}
		};
		r.params = params;
		r.originalParams = originParams;
		//初始化，绘制canvas
		var init = function() {
			var box = document.querySelector(r.params.container);
			var container = document.createElement("div");
			overlay = document.createElement("div");
			overlay.style.position = "absolute";
			overlay.style.top = "0px";
			overlay.style.left = "0px";
			overlay.style.width = r.params.width + "px";
			overlay.style.height = r.params.height + "px";
			container.className = "rub";
			canvas = document.createElement("canvas");
			canvas.setAttribute("id", "card");
			container.appendChild(canvas);
			canvas.width = r.params.width;
			canvas.height = r.params.height;
			container.style.position = "relative";
			container.style.width = r.params.width + "px";
			container.style.height = r.params.height + "px";
			container.style.backgroundImage = "url(" + r.params.backgroundImage + ")";
			container.style.backgroundRepeat = "no-repeat";
			container.style.backgroundSize = "cover";
			container.appendChild(overlay);
			box.appendChild(container);
			//判断浏览器是否支持
			if(canvas.getContext) {
				cxt = canvas.getContext("2d");
			}
			cxt.fillStyle = r.params.foreBackgroundColor;
			cxt.fillRect(0, 0, r.params.width, r.params.height);
			var downEvent = r.isSupportTouch ? "touchstart" : "mousedown";
			overlay.addEventListener(downEvent, down);
		};
		//根据像素判断刮的部分是否超过一半
		var checkHalf = function() {
				var cd = cxt.getImageData(0, 0, r.params.width, r.params.height);
				var j = 0;
				//每个像素点有四个值，这里判断每个像素点的一个值为0就行，也就是透明
				for(var i = 0; i < cd.data.length; i += 4) {
					if(cd.data[i] == 0) {
						j++;
					}
				}
				if(j >= cd.data.length / 8) {
					cxt.fillRect(0, 0, r.params.width, r.params.height);
					if(r.params.onRubEnd !== 'undefined' && (typeof r.params.onRubEnd === 'function' && !isEnd)) {
						r.params.onRubEnd();
					}
					isEnd = true;
				}
			}
			//清除遮罩层
		var clearArc = function(x, y) {
			//原有内容中与新图形不重叠的部分会被保留，也就是说新绘制的会覆盖掉原先的内容
			cxt.globalCompositeOperation = 'destination-out';
			cxt.beginPath();
			cxt.arc(x, y, r.params.fontSize, 0, Math.PI * 2, true);
			cxt.fill();
			checkHalf();
		};
		//触摸事件
		var down = function() {
			if(!isEnd) {
				var e = e || window.event;
				var moveEvent = r.isSupportTouch ? "touchmove" : "mousemove";
				var upEvent = r.isSupportTouch ? "touchend" : "mouseup";
				document.addEventListener(moveEvent, move);
				document.addEventListener(upEvent, up);
			}
		};
		//触摸移动事件
		var move = function(e) {
			var e = e || window.event;
			var touches = r.isSupportTouch ? e.touches[0] : e;
			//获取鼠标相对于canvas的坐标
			var x = (touches.clientX + document.body.scrollLeft || touches.pageX) - overlay.parentNode.offsetLeft;
			var y = (touches.clientY + document.body.scrollLeft || touches.pageY) - overlay.parentNode.offsetTop;
			clearArc(x, y);
		};
		//触摸结束事件
		var up = function(e) {
			if(!r.isSupportTouch) {
				document.removeEventListener("mousemove", move);
				document.removeEventListener("mouseup", up);
			} else {
				document.removeEventListener("touchmove", move);
				document.removeEventListener("touchend", up);
			}
		};
		init();
		return r;
	};
	//Rub属性
	Rub.prototype = {
		isSupportTouch: ("ontouchend" in document ? true : false) //判断是否支持touch事件
	};
	window.Rub = Rub;
})();
window.tool = {};
window.tool.captureMT = function(element, touchStartEvent, touchMoveEvent, touchEndEvent) {
	'use strict';
	var isTouch = ('ontouchend' in document);
	var touchstart = null;
	var touchmove = null
	var touchend = null;
	var isPressed = false;
	if(isTouch) {
		touchstart = 'touchstart';
		touchmove = 'touchmove';
		touchend = 'touchend';
	} else {
		touchstart = 'mousedown';
		touchmove = 'mousemove';
		touchend = 'mouseup';
	};
	/*传入Event对象*/
	function getPoint(event) {
		/*将当前的触摸点坐标值减去元素的偏移位置，返回触摸点相对于element的坐标值*/
		event = event || window.event;
		var touchEvent = isTouch ? event.changedTouches[0] : event;
		var x = (touchEvent.pageX || touchEvent.clientX + document.body.scrollLeft + document.documentElement.scrollLeft);
		x -= element.offsetLeft;
		var y = (touchEvent.pageY || touchEvent.clientY + document.body.scrollTop + document.documentElement.scrollTop);
		y -= element.offsetTop;
		return {
			x: x,
			y: y
		};
	};
	if(!element) return;
	/*为element元素绑定touchstart事件*/
	element.addEventListener(touchstart, function(event) {
		event.point = getPoint(event);
		touchStartEvent && touchStartEvent.call(this, event);
	}, false);

	/*为element元素绑定touchmove事件*/
	element.addEventListener(touchmove, function(event) {
		event.point = getPoint(event);
		touchMoveEvent && touchMoveEvent.call(this, event);
	}, false);

	/*为element元素绑定touchend事件*/
	element.addEventListener(touchend, function(event) {
		event.point = getPoint(event);
		touchEndEvent && touchEndEvent.call(this, event);
	}, false);
};
window.tool.intersects = function(bodyA, bodyB) {
	return !(bodyA.x + bodyA.width < bodyB.x ||
		bodyB.x + bodyB.width < bodyA.x ||
		bodyA.y + bodyA.height < bodyB.y ||
		bodyB.y + bodyB.height < bodyA.y);
};
window.tool.captureKeyDown = function(params) {
	function keyEvent(event) {
		params[event.keyCode]();
	};
	window.addEventListener('keydown', keyEvent, false);
};
window.tool.captureKeyUp = function(params) {
	function keyEvent(event) {
		params[event.keyCode]();
	};
	window.addEventListener('keyup', keyEvent, false);
};
window.tool.containsPoint = function(body, x, y) {
	return !(x < body.x || x > (body.x + body.width) ||
		y < body.y || y > (body.y + body.height));
};
//取随机数
window.tool.getRandom = function(max, min) {
	min = arguments[1] || 0;
	return Math.floor(Math.random() * (max - min + 1) + min);
};
//获取圆的边界矩形
window.tool.getBound = function(body) {
	return {
		x: (body.x - body.radius),
		y: (body.y - body.radius),
		width: body.radius * 2,
		height: body.radius * 2
	};
};
var requestAnimationFrame = function() {
	return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function(a) {
		window.setTimeout(a, 1e3 / 60, (new Date).getTime())
	};
}();
var cancelAnimationFrame = function() {
	return window.cancelAnimationFrame || window.webkitCancelAnimationFrame || window.mozCancelAnimationFrame || function(id) {
		clearTimeout(id);
	};
}();
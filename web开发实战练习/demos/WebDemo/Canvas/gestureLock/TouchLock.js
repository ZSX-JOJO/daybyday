(function() {
	var TouchLock = function(container, params) {
		'use strict';
		var n = this;
		if(!(this instanceof TouchLock)) return new TouchLock(container, params);
		var defaults = {
			width: 300,
			height: 300,
			grid: {
				cols: 3,
				rows: 3
			},
			near: true,
			correct: [1, 2, 4]
		};
		params = params || {};
		var originalParams = {};
		for(var param in params) {
			if(typeof params[param] === 'object') {
				originalParams[param] = {};
				for(var deepParam in params[param]) {
					originalParams[param][deepParam] = params[param][deepParam];
				}
			} else {
				originalParams[param] = params[param];
			}
		};
		for(var def in defaults) {
			if(typeof params[def] === 'undefined') {
				params[def] = defaults[def];
			} else if(typeof params[def] === 'object') {
				for(var deepDef in defaults[def]) {
					if(typeof params[def][deepDef] === 'undefined') {
						params[def][deepDef] = defaults[def][deepDef];
					}
				}
			}
		};
		n.params = params;
		n.originalParams = originalParams;
		n.container = typeof container === 'string' ? document.querySelectorAll(container) : container;
		if(!n.container || (n.container.length && n.container.length == 0)) return;
		if(n.container.length && n.container.length > 1) {
			var s = [];
			for(var i = 0; i < n.container.length; i++) {
				s.push(new TouchLock(n.container[i], params));
			};
			return s;
		};
		var width = n.params.width;
		var height = n.params.height;
		n.container = n.container[0] || n.container;
		n.container.style.width = width + 'px';
		n.container.style.height = height + 'px';
		var canvas = document.createElement('canvas');
		canvas.width = width;
		canvas.height = height;
		var ctx = canvas.getContext('2d');
		n.container.appendChild(canvas);
		var correctItem = [];
		var currentItem = [];
		var items = [];
		var step = 1;
		var lines = [];
		n.isPressed = false;
		var moveXY = null;
		var isError = false;

		function Item(x, y, r) {
			this.x = x;
			this.y = y;
			this.r = r;
			this.theme = 0;
		}
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
				event = event || window.event; //e.originalEvent.targetTouches[0]
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
		n.drawItem = function(item) {
			switch(item.theme) {
				case 0:
					ctx.beginPath();
					ctx.strokeStyle = '#fff';
					ctx.arc(item.x, item.y, item.r, 0, 2 * Math.PI);
					ctx.stroke();
					ctx.closePath();
					break;
				case 1:
					n.drawMoveItem(item, 'rgba(0,154,97,1)', 'rgba(255,255,255,.6)');
					break;
				case 2:
					n.drawMoveItem(item, 'rgba(247, 87, 75, 1)', 'rgba(248, 208, 205, .6)');
					break;
			}
		};

		n.drawLine = function() {
			if(lines.length > 0) {
				ctx.save();
				ctx.beginPath();
				ctx.strokeStyle = isError ? 'rgba(247, 87, 75, 1)' : 'rgba(0,154,97,1)';
				ctx.lineWidth = 4;
				for(var i = 0; i < lines.length; i++) {
					if(i == 0) {
						ctx.moveTo(lines[i].x, lines[i].y);
					};
					lines[i + 1] && ctx.lineTo(lines[i + 1].x, lines[i + 1].y);
				};
				moveXY && ctx.lineTo(moveXY.x, moveXY.y);
				ctx.stroke();
				ctx.closePath();
				ctx.restore();
			}
		};

		n.drawMoveItem = function(item, c1, c2) {
			ctx.beginPath();
			ctx.fillStyle = c2;
			ctx.arc(item.x, item.y, item.r, 0, 2 * Math.PI);
			ctx.fill();
			ctx.closePath();

			ctx.beginPath();
			ctx.fillStyle = c1;
			ctx.arc(item.x, item.y, item.r * 0.3, 0, 2 * Math.PI);
			ctx.fill();
			ctx.closePath();

			ctx.beginPath();
			ctx.strokeStyle = c1;
			ctx.arc(item.x, item.y, item.r, 0, 2 * Math.PI);
			ctx.stroke();
			ctx.closePath();
		};
		n.drawBg = function() {
			if(!n.params.bg) {
				ctx.fillStyle = '#ddd';
				ctx.fillRect(0, 0, width, height);
			};
		};
		n.isInCircle = function(b, x, y) {
			var mx = x - b.x;
			var my = y - b.y;
			var mr = Math.sqrt(mx * mx + my * my);
			if(mr < b.r) {
				return true;
			};
			return false;
		};
		n.pageInit = function() {
			var c = n.params.grid.cols;
			var r = n.params.grid.rows;
			var w = Math.floor(width / c);
			var h = Math.floor(height / r);
			n.drawBg();
			for(var i = 0; i < r * c; i++) {
				var x = Math.floor(w / 2) + Math.floor(i % c) * w; // i % c表示在第几列
				var y = Math.floor(h / 2) + Math.floor(i / c) * h; // i / c表示在第几行
				var r = Math.floor(w / 2 * 0.6);
				var item = new Item(x, y, r);
				item.i = i;
				items.push(item);
			};
			n.eventInit();
			n.animate();
		};
		n.eventInit = function() {
			function check(e) {
				var c = n.params.grid.cols;
				var isNear = true;
				items.forEach(function(v) {
					if(v.theme != 1 && n.isInCircle(v, e.point.x, e.point.y)) {
						if(lines.length > 0 && n.params.near) {
							var a = v.i;
							var b = lines[lines.length - 1].i;
							isNear = Math.abs(a % c - b % c) < 2 &&
								Math.abs(Math.floor(a / c) - Math.floor(b / c)) < 2;
						} else {
							isNear = true;
						};
						if(isNear) {
							v.theme = 1;
							lines.push(v);
						}
					}
				});
			}

			function mousedown(e) {
				n.isPressed = true;
				check(e);
			};

			function mousemove(e) {
				if(n.isPressed) {
					check(e);
					moveXY = {
						x: e.point.x,
						y: e.point.y
					};
				}
			};

			function mouseup(e) {
				n.isPressed = false;
				moveXY = null;
				if(n.check()) {
					n.params.onSuccess && n.params.onSuccess(n);
				} else {
					isError = true;
					items.forEach(function(v) {
						if(v.theme == 1) {
							v.theme = 2;
						}
					});
					n.params.onError && n.params.onError(n);
					setTimeout(function() {
						n.reset();
					}, 1000);
				}
			};
			tool.captureMT(canvas, mousedown, mousemove, mouseup);
		};
		n.reset = function() {
			items.forEach(function(v) {
				v.theme = 0;
			});
			lines = [];
			isError = false;
		};
		n.check = function() {
			var isTrue = true;
			for(var i = 0; i < lines.length; i++) {
				if(lines[i].i != n.params.correct[i]) {
					isTrue = false;
					break;
				}
			};
			return isTrue;
		};
		n.animate = function() {
			n.drawBg();
			items.forEach(function(v) {
				n.drawItem(v);
			});
			n.drawLine();
			requestAnimationFrame(n.animate);
		}
		n.pageInit();
		return n;
	};
	window.TouchLock = TouchLock;
})();
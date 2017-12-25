(function() {
	var Snow = function(container, params) {
		'use strict';
		var n = this;
		if(!(this instanceof Snow)) return new Snow(container, params);
		var defaults = {
			speed: 3
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
				s.push(new Snow(n.container[i], params));
			};
			return s;
		};
		n.container = n.container[0] || n.container;
		var getRandom = function(max, min) {
			min = arguments[1] || 0;
			return Math.floor(Math.random() * (max - min + 1) + min);
		};
		var canvas = document.createElement('canvas');
		var width = n.container.offsetWidth;
		var height = n.container.offsetHeight;
		canvas.width = width;
		canvas.height = height;
		var ctx = canvas.getContext('2d');
		n.container.appendChild(canvas);
		var items = [];
		var img = new Image();

		function Item(x, y, r) {
			this.x = x;
			this.y = y;
			this.r = r;
			this.vx = 0;
			this.vy = 5;
			this.deg = 0;
		};

		function drawItem(body) {
			ctx.save();
			ctx.rotate(body.deg / 180 * Math.PI);
			//利用径向渐变模拟雪花
			var rg = ctx.createRadialGradient(body.x, body.y, Math.floor(body.r / 4), body.x, body.y, body.r);
			rg.addColorStop(0, "rgba(255,255,255,1)");
			rg.addColorStop(1, "rgba(255,255,255,0.1)");
			ctx.fillStyle = rg;
			ctx.beginPath();
			ctx.arc(body.x, body.y, body.r, 0, 2 * Math.PI, true);
			ctx.fill();
			ctx.restore();
		};

		function add() {
			for(var i = 0; i < n.params.speed; i++) {
				var r = getRandom(10, 2);
				var vy = getRandom(5, 2);
				var deg = getRandom(10, -10);
				var x = Math.floor(Math.random() * width);
				var item = new Item(x, -r, r);
				item.vy = vy;
				item.deg = deg;
				items.push(item);
			};
		};

		n.pageInit = function() {
			if(n.params.bg && typeof n.params.bg === 'string') {
				if(img.complete) {
					n.animate();
				} else {
					img.onload = function() {
						n.animate();
					};
					img.onerror = function() {

					};
				};
				img.src = n.params.bg;
			} else {
				n.animate();
			};
		};
		n.animate = function() {
			add();
			(function() {
				ctx.clearRect(0, 0, width, height);
				n.params['bg'] && ctx.drawImage(img, 0, 0, width, height);
				var i = items.length;
				while(i--) {
					var y = items[i].y;
					var x = items[i].x;
					var rotation = items[i].deg / 180 * Math.PI;
					//将旋转后的坐标转化为相对于原始坐标系的坐标
					var x1 = x * Math.cos(rotation) + y * Math.sin(rotation);
					var y1 = y * Math.cos(rotation) - x * Math.sin(rotation);
					//判断是否离开画面
					if(x1 > width || x1 < 0 || y1 > height) {
						items.splice(i, 1);
					} else {
						items[i].x += items[i].vx;
						items[i].y += items[i].vy;
						drawItem(items[i]);
					};
				};
				//requestAnimationFrame动画，亦可用setInterval或setTimeout替换
				requestAnimationFrame(n.animate);
			})();
		};
		n.pageInit();
		return n;
	};
	window.Snow = Snow;
})();
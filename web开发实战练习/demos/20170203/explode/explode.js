(function() {
	var Explode = function(container, params) {
		'use strict';
		var n = this;
		if(!(this instanceof Explode)) return new Explode(container, params);
		var defaults = {
			img: 'chi2.png',
			type: 1
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
				s.push(new Explode(n.container[i], params));
			};
			return s;
		};
		n.container = n.container[0] || n.container;

		var width = n.params.width;
		var height = n.params.height;
		var wWidth = document.body.clientWidth;
		var wHeight = document.body.clientHeight;

		n.container.width = width;
		n.container.height = height;
		var ctx = n.container.getContext('2d');
		var c = document.createElement('canvas');
		var ct = c.getContext('2d');
		var items = [];
		var picture = null;
		var requestId = null;
		var total = 0;
		var getRandom = function(max, min) {
			min = arguments[1] || 0;
			return Math.floor(Math.random() * (max - min + 1) + min);
		};

		function cutSlice() {
			ctx.clearRect(0, 0, n.container.width, n.container.height);
			for(var i = 0; i < c.width * c.height; i++) {
				var item = items[i];
				var targetX = item.targetX;
				var targetY = item.targetY;
				var currentX = item.currentX;
				var currentY = item.currentY;
				var ax = false;
				var ay = false;
				if(!item.isLock) {
					if(Math.abs(targetX - currentX) <= .5) {
						item.currentX = targetX;
						ax = true;
					} else {
						item.currentX += (targetX - currentX) * item.ax;
					};
					if(Math.abs(targetY - currentY) <= .5) {
						item.currentY = targetY;
						ay = true;
					} else {
						item.currentY += (targetY - currentY) * item.ay;
					};
					if(ax && ay) {
						total--;
						item.isLock = true;
					}
				};
				var ix = item.currentX;
				var iy = item.currentY;
				ctx.putImageData(item.data, ix, iy);
			};
			if(total > 0) {
				requestId = requestAnimationFrame(cutSlice);
			} else {
				cancelAnimationFrame(requestId);

			};
		}

		function Item(data, targetX, targetY, currentX, currentY) {
			this.data = data;
			this.targetX = targetX;
			this.targetY = targetY;
			this.currentX = currentX;
			this.currentY = currentY;
			this.ax = .13 - Math.random() * .06;
			this.ay = .16 - Math.random() * .08;
		}

		function drawCanvas() {
			if(n.params.type == 2) {
				picture = new Image();
				picture.crossOrigin = "";
				picture.onload = function() {
					var pw = picture.width;
					var ph = picture.height;
					c.width = pw;
					c.height = ph;
					ct.drawImage(picture, 0, 0, pw, ph, 0, 0, pw, ph);
					draw(pw, ph);
				};
				picture.src = n.params.img;
			} else {
				var word = n.params.text;
				ct.font = '60px Arial';
				var w = ct.measureText(word).width;
				var h = 100;
				c.width = w;
				c.height = h;
				ct.fillStyle = 'red';
				ct.font = '60px Arial';
//				ct.textAlign = 'center';
				ct.textBaseline = 'middle';
				ct.fillText(word, 0, 50);
				draw(w, h);
			}

			function draw(pw, ph) {
				var w = 1;
				var h = 1;
				var cols = Math.floor(pw / w);
				var rows = Math.floor(ph / h);
				for(var i = 0; i < c.width * c.height; i++) {
					var x = Math.floor(i % cols);
					var y = Math.floor(i / cols);
					var data = ct.getImageData(x * w, y * h, w, h);
					var vx = getRandom(300, -300);
					var vy = getRandom(500, -500);
					var item = new Item(data, x, y, x + vx, y + vy);
					items.push(item);
				};
				total = items.length;
				cutSlice();
			}
		}
		n.pageInit = function() {
			drawCanvas();
		};

		n.pageInit();
		return n;
	};
	window.Explode = Explode;
})();
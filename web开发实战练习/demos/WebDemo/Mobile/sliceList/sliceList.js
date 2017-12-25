(function() {
	var SliceList = function(container, params) {
		var n = this;
		var options = {
			type: 1
		};
		var originParams = {};
		params = params || {};
		for(var param in params) {
			if(typeof params[param] === 'object') {
				originParams[param] = {};
				for(var defPa in params[param]) {
					originParams[param][defPa] = params[param][defPa];
				}
			} else { 
				originParams[param] = params[param];
			}
		};
		for(var opt in options) {
			if(typeof params[opt] === 'object') {
				for(var defOpt in options[opt]) {
					if(typeof params[opt][defOpt] === 'undefined') {
						params[opt][defOpt] = options[opt][defOpt];
					}
				}
			} else if(typeof params[opt] === 'undefined') {
				params[opt] = options[opt];
			}
		};
		n.originParams = originParams;
		n.params = params;
		n.container = typeof container === 'string' ? document.querySelectorAll(container)[0] : container;
		if(!n.container || (n.container.length && n.container.length == 0)) return;
		if(n.container.length && n.container.length > 1) {
			for(var i = 0; i < n.container.length; i++) {
				var scroll = [];
				scroll.push(n.container[i]);
			}
			return scroll;
		};
		n.container = n.container[0] || n.container;
		var setTransitionDuration = function(element, times) {
			element.style.webkitTransitionDuration = times + 'ms';
			element.style.mozTransitionDuration = times + 'ms';
			element.style.oTransitionDuration = times + 'ms';
			element.style.transitionDuration = times + 'ms';
		};
		var transitionEnd = function(elem, handler) {
			elem.addEventListener('transitionend', handler, false);
			elem.addEventListener('webkitTransitionEnd', handler, false);
			elem.addEventListener('mozTransitionEnd', handler, false);
			elem.addEventListener('oTransitionEnd', handler, false);
		};
		var deleteTransitionEnd = function(elem, handler) {
			elem.removeEventListener('transitionend', handler, false);
			elem.removeEventListener('webkitTransitionEnd', handler, false);
			elem.removeEventListener('mozTransitionEnd', handler, false);
			elem.removeEventListener('oTransitionEnd', handler, false);
		};
		var setTransform = function(element, animation) {
			element.style.webkitTransform = animation;
			element.style.mozTransform = animation;
			element.style.oTransform = animation;
			element.style.msTransform = animation;
			element.style.transform = animation;
		};
		var util = {
			pageX: 0,
			activeItem: null,
			isTouch: false,
			left: 0,
			width: 0,
			tool: null,
			touchstart: function(e) {
				e = e.changedTouches[0];
				util.pageX = e.pageX;
				util.activeItem = this.querySelector('.slice-content');
				util.isTouch = true;
				util.tool = this.querySelector('.slice-tool');
				util.width = util.tool.offsetWidth;
				util.left = util.activeItem.style.left;
				util.left = util.left ? parseInt(util.left) : 0;
				document.body.addEventListener('touchmove', util.touchmove);
				document.body.addEventListener('touchend', util.touchend);
			},
			touchmove: function(e) {
				e = e.changedTouches[0];
				if(util.isTouch) {
					var border = util.width;
					util.left += e.pageX - util.pageX;
					if(util.left >= 0) {
						util.left = 0;
					} else if(Math.abs(util.left) >= border) {
						util.left = -border;
					};
					setTransitionDuration(util.activeItem, 0);
					setTransitionDuration(util.tool, 0);
					util.activeItem.style.left = util.left + 'px';
					if(util.type == 2) {
						util.tool.style.right = -(border + util.left) + 'px';
					};
					util.pageX = e.pageX;
				}
			},
			touchend: function(e) {
				if(Math.abs(util.left) > util.width / 2) {
					util.left = -util.width;
				} else {
					util.left = 0;
				};
				setTransitionDuration(util.activeItem, 200);
				setTransitionDuration(util.tool, 200);
				if(util.type == 2) {
					util.tool.style.right = -(util.width + util.left) + 'px';
				};
				util.activeItem.style.left = util.left + 'px';
				util.isTouch = false;
				util.activeItem = null;
				util.pageX = 0;
			}
		};
		n.refresh = function() {
			var items = n.container.querySelectorAll('.slice-item');
			util.type = n.container.classList.contains('slice-non') ? 2 : 1;
			for(var j = 0; j < items.length; j++) {
				var t = items[j].querySelector('.slice-tool');
				if(util.type == 2) {
					t.style.right = -t.offsetWidth + 'px';
				};
				items[j].addEventListener('touchstart', util.touchstart);
			}
		};
		n.pageInit = function() {
			n.refresh();
		};
		n.pageInit();
	};
	window.SliceList = SliceList;
})();
+ function() {
	// 给所有accordion-item-toggle(打开/关闭)添加点击事件
	// handle 处理 capture 捕获
	var collapse = document.querySelectorAll('.accordion-item');
	var addEvent = function(dom, type, handle, capture) {
		if(dom.addEventListener) {
			dom.addEventListener(type, handle, capture);
		} else if(dom.attachEvent) {
			dom.attachEvent("on" + type, handle);
		}
	};
	//绑定过渡结束的事件监听
	var transitionEnd = function(elem, handler) {
		elem.addEventListener('transitionend', handler, false);
		elem.addEventListener('webkitTransitionEnd', handler, false);
		elem.addEventListener('mozTransitionEnd', handler, false);
		elem.addEventListener('oTransitionEnd', handler, false);
	};
	//移除过渡结束的事件监听
	var deleteTransitionEnd = function(elem, handler) {
		elem.removeEventListener('transitionend', handler, false);
		elem.removeEventListener('webkitTransitionEnd', handler, false);
		elem.removeEventListener('mozTransitionEnd', handler, false);
		elem.removeEventListener('oTransitionEnd', handler, false);
	};
	//设置css3过渡时间
	var setTransitionDuration = function(element, times) {
		if(typeof times === 'number') {
			times = times + 'ms';
		};
		element.style.webkitTransitionDuration = times;
		element.style.mozTransitionDuration = times;
		element.style.oTransitionDuration = times;
		element.style.transitionDuration = times;
	};
	var accordionCallapse = {
		transitionEnd: function() {
			var content = this;
			var item = this.parentNode;
			if(item.classList.contains('accordion-item-expand')) {
				setTransitionDuration(content, 0);
				content.style.height = 'auto';
				// 延迟过渡
				var clientLeft = content.clientLeft;
				setTransitionDuration(content, '');
			} else {
				content.style.height = '';
			}
		},
		open: function(item) {
			var content = item.querySelector('.accordion-item-content');
			content.style.height = content.scrollHeight + 'px';
			// 移除过渡结束的事件监听
			deleteTransitionEnd(content, accordionCallapse.transitionEnd);
			// 绑定过渡结束的事件监听
			transitionEnd(content, accordionCallapse.transitionEnd);
			item.classList.add('accordion-item-expand');
		},
		close: function(item) {
			var content = item.querySelector('.accordion-item-content');
			item.classList.remove('accordion-item-expand');
			setTransitionDuration(content, 0);
			content.style.height = content.scrollHeight + 'px';
			var clientLeft = content.clientLeft;
			setTransitionDuration(content, '');
			content.style.height = '';
			// 移除过渡结束的事件监听
			deleteTransitionEnd(content, accordionCallapse.transitionEnd);
			// 绑定过渡结束的事件监听
			transitionEnd(content, accordionCallapse.transitionEnd);
		}
	};
	for(var i = 0; i < collapse.length; i++) {
		addEvent(collapse[i].querySelector('.accordion-item-toggle'), 'click', function() {
			var parent = this.parentNode.parentNode;
			if(parent.classList.contains('accordion-list')) {
				var items = parent.querySelectorAll('.accordion-item.accordion-item-expand');
				for(var j = 0; j < items.length; j++) {
					if(items[j] != this.par) {
						accordionCallapse.close(items[j]);
					}
				}
			};
			var con = this.nextElementSibling;
			if(!con) return;
			if(this.parentNode.classList.contains('accordion-item-expand')) {
				accordionCallapse.close(this.parentNode);
			} else {
				accordionCallapse.open(this.parentNode);
			}
		}, false);
	}
}();
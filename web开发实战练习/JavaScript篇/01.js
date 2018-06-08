/**
 * [此波纹方法描述 以及延伸]
 * @return {[type]} [description]
 * 运算符加载函数定义的前面，则是将函数看做一个整体，然后再调用这个函数，并对返回的结构进行逻辑运算
 * (function(){})(); 意思是执行这个函数声明。有的叫法是 “匿名自动执行函数”，更准确的表示应该为 “立即执行函数”
 */
/**
 * [立即执行函数的其他写法]
 * @return {[type]} [description]
 * (function(){})
 * (function(){})()
 * !function(){}()
 * 在函数声明前 加一元运算符 甚至将一元运算符进行组合 例如 "+ - ++ -- !" 其他运算符 目前发现不可以用
 */
!function() {
	var addEvent = function(dom, type, handle, capture) {//handle 处理 capture 捕获
		//document.addEventListener() 方法用于向文档添加事件句柄。
		if(dom.addEventListener) {
			// addEventListener 给一个事件指派多个处理过程
			dom.addEventListener(type, handle, capture);
		} else if(dom.attachEvent) {
			// attachEvent为了兼容ie8以及更早版本ie 和其他浏览器的特殊版本号
			dom.attachEvent("on" + type, handle);
		}
	};
	var animationEnd = function(elem, handler) {
		// animationend 事件
		elem.addEventListener('animationend', handler, false);
		elem.addEventListener('webkitAnimationEnd', handler, false);
		elem.addEventListener('mozAnimationEnd', handler, false);
		elem.addEventListener('OAnimationEnd', handler, false);
	};

	/**
	 * [ripple description]
	 * @param  {[type]} event [description]
	 * @param  {[type]} $this [description]
	 * @return {[type]}       [description]
	 * 获取鼠标位置 获取波纹元素的高度和left/top 添加rippleEffect动画 监听动画结束
	 */
	function ripple(event, $this) {
		event = event || window.event;
		// 获取鼠标位置
		// pageX/Y 获取出发点相对于文档区域左上角距离,随页面变化而改变
		// 或 后面为兼容IE
		var x = event.pageX || document.documentElement.scrollLeft + document.body.scrollLeft + event.clientX;
		var y = event.pageY || document.documentElement.scrollTop + document.body.scrollTop + event.clientY;
		// 本身波纹元素ripple的中心点是在元素的中心，所以我们根据鼠标位置和元素的位置，计算应该偏移的位置
		var wx = $this.offsetWidth;
		x = x - $this.offsetLeft - wx / 2;
		y = y - $this.offsetTop - wx / 2;
		// 添加.ripple元素
		var ripple = document.createElement('span');
		ripple.className = 'ripple';
		// firstChild 属性返回被选节点的第一个子节点
		var firstChild = $this.firstChild;
		if(firstChild) {
			// insertBefore() 方法可在已有的子节点前插入一个新的子节点
			$this.insertBefore(ripple, firstChild);
		} else {
			// appendChild() 方法可向节点的子节点列表的末尾添加新的子节点
			$this.appendChild(ripple);
		};
		ripple.style.cssText = 'width: ' + wx + 'px;height: ' +
			wx + 'px;top: ' + y + 'px;left: ' + x + 'px';
		ripple.classList.add('rippleEffect');
		// 监听动画结束,删除波纹元素
		animationEnd(ripple, function() {
			this.parentNode.removeChild(ripple);
		});
	};
	// 给包含类名ripple-effect的元素需要添加点击事件
	var btn = document.querySelectorAll('.ripple-effect');
	for(var i = 0; i < btn.length; i++) {
		addEvent(btn[i],'click',function(e){
			ripple(e, this);
		});
	}
}();
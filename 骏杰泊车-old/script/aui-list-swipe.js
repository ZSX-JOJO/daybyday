/**
 * aui-list-swipe.js 列表页滑动菜单
 * verson 0.0.3
 * @author 流浪男 && Beck
 * http://www.auicss.com
 * @todo more things to abstract, e.g. Loading css etc.
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 */
 (function(window) {
	"use strict";
	var translateVal,
		friction = 1,
		firstTouchX,
		firstTouchxy,
		firstTouchY,
		firstTouch,
		firstTouchTime,
		touchXDelta,
		handleTranslateVal;
	var TranslateZero = "translate3d(0,0,0)",
		TranslateCent = "translate3d(100%,0,0)";
	var swipeHandle = false,
		btnWidth = false,
		swipeBtnsRight = false;
	var isMoved = false,isOpened=false,isTouching=false;
	var d = false;
	var auiListSwipe = function (callback) {
		this._init(callback);
	}
	auiListSwipe.prototype = {
		_init: function(callback){
			var self = this;
            var handles = document.querySelectorAll(".aui-swipe-item");

            // if(handles.length){
                // for(var i=0; i<handles.length;i++){
                    // self.toggleEvents(handles[i],callback);
                // }
            // }
            // if(isOpened){
                window.addEventListener('touchstart', function(event){
                    isTouching = true;
                    // console.log(1)
                    // if(document.querySelector(".aui-swipe-opened")){
                        // event.stopPropagation()
                        // isOpened = false;
                        var target = event.target;

            			// 过滤点击
            			for(; target && target !== document; target = target.parentNode){
                            // console.log(target.classList)
                            if(isOpened){
                                // console.log(1);
                                event.preventDefault();
                				if(document.querySelector(".aui-swipe-opened")){
                					event.preventDefault();
                					// if(swipeHandle != document.querySelector(".aui-swipe-opened")){
            						self.setTranslate(document.querySelector(".aui-swipe-opened"),"0px");
                                    // setTimeout(function(){
                                        // event.preventDefault();
                                        event.stopPropagation();
                                        isOpened = false;
                                        isMoved = true;
                                        return;
                                    // },300)
                					// }
                				}
                                break;
                            }
            				if (target.classList && target.classList.contains("aui-swipe-item")){
                                firstTouch = event.changedTouches[0];
                				firstTouchX = firstTouch.clientX;
                				firstTouchY = firstTouch.clientY;
                				firstTouchTime = event.timeStamp;
                                // console.log(1)
                                self.toggleEvents(target,callback);
            					// if (target.classList.contains("aui-swipe-btn")) {
            					// 	return;
            					// }
            				}
            			}
                        // isMoved = false;
                        // isOpened = false;
                        // self.setTranslate(document.querySelector(".aui-swipe-opened"),"0px");
                        // document.querySelector(".aui-swipe-opened").classList.remove("aui-swipe-opened");

                        // event.stopPropagation();
    				// }
    			})
                window.addEventListener("touchend",function(event){
                    // console.log(1)
                    if(document.querySelector(".aui-swipe-opened") && isMoved){
                        // event.stopPropagation();
                        // console.log(1)
                        document.querySelector(".aui-swipe-opened").classList.remove("aui-swipe-opened");
                        // setTimeout(function(){
                            isOpened = false;
                        // },300)

                        // isMoved = false;
                        return;
                    }

                })
            // }

		},
		toggleEvents:function(element,callback){
			var self = this;
			self.setTransform(element,300);
			element.addEventListener('touchstart', function(event){
                // console.log(document.querySelector(".aui-swipe-opened"))
                // console.log(event.target.parentNode)
                // event.stopPropagation()
				//:active样式引起列表背景色冲突
                // firstTouch = event.changedTouches[0];
				// firstTouchX = firstTouch.clientX;
				// firstTouchY = firstTouch.clientY;
				// firstTouchTime = event.timeStamp;
				// element.style.backgroundColor = "#ffffff";
				// if(!element.nextSibling)return;
			},false)
			element.addEventListener('touchmove', function(event){
                // console.log(isTouching)
                // console.log(2)
                // event.stopPropagation();
                if(isOpened)return;
				// event.preventDefault();
				// if(document.querySelector(".aui-swipe-opened")){
				// 	event.preventDefault();
				// 	if(swipeHandle != document.querySelector(".aui-swipe-opened")){
				// 		self.setTranslate(document.querySelector(".aui-swipe-opened"),"0px");
			    //     	document.querySelector(".aui-swipe-opened").classList.remove("aui-swipe-opened");
			    //     	isOpened = false;
			    //     	event.stopPropagation()
			    //     	return;
				// 	}
				// }
				self.setTransform(element,0);
				if(element.querySelector(".aui-swipe-btn")){
					btnWidth = element.querySelector(".aui-swipe-btn").offsetWidth;
				}
				var touchMoveObj = event.changedTouches[0],
					touchX = touchMoveObj.clientX;
				touchXDelta = -Math.pow(firstTouchX-touchX, 0.85);

				handleTranslateVal = touchXDelta/friction;
		        var moveX = touchMoveObj.clientX - firstTouchX;
		        var moveY = touchMoveObj.clientY - firstTouchY;
		        var direction = self.getDirection(moveX,moveY);
                // console.log(direction)
		        var angle = self.getAngle(Math.abs(moveX),Math.abs(moveY));
		        // console.log(moveX);

		        // // 解决滑动屏幕返回时事件冲突，主要针对部分特殊机型
		        // if(touchMoveObj.screenX < 0){
		        // 	firstTouchxy = '';
		        // }
                // console.log(angle)
                if(angle <= 15 && direction === 'left'){
		        	event.preventDefault()
		        	isMoved = true;
		        }
		        if(direction == "right"){
		        	isMoved = false;
		        	event.preventDefault();
		        }
		        if((direction == "top" || direction == "down") && !isMoved){
		        	isMoved = false;
		        	return;
		        }

		        if((event.timeStamp - firstTouchTime) >= 100 && touchXDelta < 0 && touchMoveObj.screenX > 0 && isMoved){
		        	if(element.className.indexOf("aui-swipe-opened") <= -1){
						if((handleTranslateVal+10) > -btnWidth){
                            isMoved = true;
				        	self.setTranslate(element,""+(handleTranslateVal+10)+"px");
				        }
					}
			    }
			},false)
			element.addEventListener('touchend', function(event){
                // if(!isMoved || isOpened){
                //     isOpened = false;
                //     self.setTransform(element,300);
                //     self.setTranslate(element,"0px");
                //     return;
                // };
                if(isOpened)return;
				self.setTransform(element,300);
				var touchEndObj = event.changedTouches[0];
				var touchEndxy = {
						x: touchEndObj.clientX || 0,
						y: touchEndObj.clientY || 0
					};
				var toucheEndX = touchEndObj.clientX - firstTouchX;
		        var toucheEndY = touchEndObj.clientY - firstTouchY;

		        var direction = self.getDirection(toucheEndX,toucheEndY);
	        	if(direction=='left' && handleTranslateVal < (-btnWidth/1.7) && isMoved){
		        	self.setTranslate(element,""+-btnWidth+"px");
		        	element.classList.add("aui-swipe-opened");
                    isOpened = true;
                    isMoved = false;
                    return;
		        	// isOpened = true;
				// }else if(isOpened && !isMoved){
                }else{
                    // console.log(22)
					// element.classList.remove("aui-swipe-opened");
		        	// self.setTranslate(element,"0px");
		        	// isOpened = false;
                    // isMoved = false;
				}
			},true)
		},
		setTransform : function (el,value){
			el.style.webkitTransitionDuration = el.style.transitionDuration = value+'ms';
		},
		setTranslate : function (el,value){
			if(el)el.style.webkitTransform = el.style.transform = "translate3d("+value+",0,0)";
            // if(el)el.style.right = value+"px";
		},
		getDistance : function(p1, p2, props) {
			if (!props) { props = ['x', 'y'];}
			var x = p2[props[0]] - p1[props[0]];
			var y = p2[props[1]] - p1[props[1]];
			return Math.sqrt((x * x) + (y * y));
		},
		getAngle:function(moveX, moveY){
		       // var x = Math.abs(x1 - x2);
		       // var y = Math.abs(y1 - y2);
		       var z = Math.sqrt(moveX*moveX + moveY*moveY);
		       return  Math.round((Math.asin(moveY / z) / Math.PI*180));
		},
		getDirection : function(diffX, diffY) {
			if (diffX === diffY) { return '';}
			if (Math.abs(diffX) >= Math.abs(diffY)) {
	            return diffX > 0 ? 'right' : 'left';
	        } else {
	           	return diffY > 0 ? 'down' : 'up';
	        }
		}
	}
	window.auiListSwipe = auiListSwipe;
})(window);

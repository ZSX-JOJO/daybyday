/**
 * aui-commentbox.js
 * @author 流浪男
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 */
(function( window, undefined ) {
    "use strict";
    var auiCommentbox = function() {
    };
    var isShow = false;
    auiCommentbox.prototype = {
        init: function(params,callback){
            this.frameBounces = params.frameBounces;
            this.cancelButton = params.cancelButton;
            this.confirmButton = params.confirmButton;
            this.buttonLocation = params.buttonLocation;
            this.fcousDelayed = params.fcousDelayed||0;
            this.text = params.text||'';
            this.maskDiv;
            this.auiCommentDiv;
            var self = this;

            self.open(params,callback);
        },
        open: function(params,callback) {
            var shareboxHtml='',commentHtml = '',buttonsHtml = '';
        	var self = this;
            if(self.auiCommentDiv)return;
            if(!self.maskDiv){
                self.maskDiv = document.createElement("div");
                self.maskDiv.className = "aui-mask";
                document.body.appendChild(self.maskDiv);
            }
            self.auiCommentDiv = document.createElement("div");
            self.auiCommentDiv.className = "aui-card-list aui-comment-box";
            document.body.appendChild(self.auiCommentDiv);
            if(params.buttonLocation == 'top'){
                commentHtml +=  '<div class="aui-card-list-header">'+
                                    '<div><div class="aui-btn aui-comment-box-cancel" tapmode>'+self.cancelButton+'</div></div>'+
                                    '<div>'+
                                        '<div class="aui-btn aui-comment-box-confirm" tapmode>'+self.confirmButton+'</div>'+
                                    '</div>'+
                                '</div>';
                commentHtml +=   '<div class="aui-card-list-content">'+
                                '<textarea></textarea>'+
                            '</div>';
            }else{
                commentHtml +=   '<div class="aui-card-list-content-padded">'+
                                    '<textarea placeholder="'+self.text+'"></textarea>'+
                                '</div>';
                commentHtml +=  '<div class="aui-card-list-footer">'+
                                    '<div><div class="aui-btn aui-comment-box-cancel" tapmode>'+self.cancelButton+'</div></div>'+
                                    '<div>'+
                                        '<div class="aui-btn aui-comment-box-confirm" tapmode>'+self.confirmButton+'</div>'+
                                    '</div>'+
                                '</div>';
            }

            self.auiCommentDiv.innerHTML = commentHtml;
            var actionsheetHeight = self.auiCommentDiv.offsetHeight;
            self.maskDiv.classList.add("aui-mask-in");
            self.auiCommentDiv.style.webkitTransform = self.auiCommentDiv.style.transform = "translate3d(0,0,0)";
            self.auiCommentDiv.style.opacity = 1;
            self.auiCommentDiv.addEventListener("touchmove", function(event){
                event.preventDefault();
            })
            self.maskDiv.addEventListener("touchmove", function(event){
                event.preventDefault();
            })
            if(typeof(api) != 'undefined' && typeof(api) == 'object' && self.frameBounces){
                api.parseTapmode();
                api.setFrameAttr({
                    bounces:false
                });
            }
            document.querySelector(".aui-comment-box textarea").addEventListener('input', function() {
                if(document.querySelector(".aui-comment-box-confirm")){
                    if(this.value.length > 10){
                        document.querySelector(".aui-comment-box-confirm").classList.add("aui-active");
                    }else{
                        document.querySelector(".aui-comment-box-confirm").classList.remove("aui-active");
                    }
                }

            })
            if(self.fcousDelayed > 0){
                setTimeout(function(){
                    document.querySelector(".aui-comment-box textarea").focus();
                    self.maskDiv.onclick = function(){self.close();return;};
                }, self.fcousDelayed)
            }else{
                document.querySelector(".aui-comment-box textarea").focus();
                self.maskDiv.onclick = function(){self.close();return;};
            }
            if(document.querySelector(".aui-comment-box-cancel"))document.querySelector(".aui-comment-box-cancel").onclick = function(){self.close();return;};

            if(document.querySelector(".aui-comment-box-confirm"))document.querySelector(".aui-comment-box-confirm").onclick = function(){
                if(callback){
                    callback({
                        inputValue:document.querySelector(".aui-comment-box textarea").value
                    });
                };
                self.close();
                return;
            };
        },
        close: function(){
            var self = this;
            if(typeof(api) != 'undefined' && typeof(api) == 'object' && self.frameBounces){
                api.setFrameAttr({
                    bounces:true
                });
            }
            if(self.auiCommentDiv){
                var actionsheetHeight = self.auiCommentDiv.offsetHeight;
                self.auiCommentDiv.style.webkitTransform = self.auiCommentDiv.style.transform = "translate3d(0,"+actionsheetHeight+"px,0)";
                self.maskDiv.style.opacity = 0;
                setTimeout(function(){
                    if(self.maskDiv){
                        self.maskDiv.parentNode.removeChild(self.maskDiv);
                    }
                    self.auiCommentDiv.parentNode.removeChild(self.auiCommentDiv);
                    self.maskDiv = self.auiCommentDiv = false;
                }, 300)
            }
        }
    };
	window.auiCommentbox = auiCommentbox;
})(window);
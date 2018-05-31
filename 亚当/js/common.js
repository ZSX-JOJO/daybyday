$(function(){

	// banner处获取浏览器高度
	$(window).resize(function(){
		$('.banner img').height($(window).height());
	}).trigger('resize');
	
	// 返回顶部
	// $("#top").click(function() {
	//     $("html,body").animate({scrollTop:0}, 500);
	//  }); 
	 $("#top").click(function(){
		 $("html,body").animate({scrollTop:0},5000);
	 });
});
### APP项目开发前端培训

#### 1、样式初始化

​	body

​	ul ,li a

#### 2、rem使用

html  font-size:20px  

14px/20 = 0.7rem;

宽度，高度，内外边距，字号，行距 

border不要使用

#### 3、线条处理

1px线条的处理

#### 4、弹性布局



#### 5、常用原生JavaScript

dom jquery zepto

document touch 

#### 6、js与css3动画结合

rotate  角度

scale  缩放



#### 7、position在移动端的特殊性

static

relative

absolute  

fixed



app

css 

js

html

1-css

html

js





ajax



单条数据

分页数据 （下拉刷新，上拉加载）

	var page = 1;//全局
	apiready = function(){
	api.setCustomRefreshHeaderInfo({
	    bgColor: '#ffffff',
	    isScale: true,
	    image: {
	        pull: [
	            'widget://image/refresh/dropdown0.png',
	            'widget://image/refresh/dropdown0.png',
	            'widget://image/refresh/dropdown0.png',
	            'widget://image/refresh/dropdown0.png',
	            'widget://image/refresh/dropdown0.png',
	            'widget://image/refresh/dropdown1.png'
	        ],
	        load: [
	            'widget://image/refresh/loading0.png',
	            'widget://image/refresh/loading1.png'
	        ]
	    }
	}, function() {
	    page = 1;
	    getData('down');
	    api.refreshHeaderLoadDone();
	});
	api.addEventListener({
	    name:'scrolltobottom',
	    extra:{
	        threshold:150
	    }
	},function(ret,err){
	    getData('up');
	});
	}
	
	<!-- 加载数据 -->
	function getData(type){
	api.ajax({
	    url: 'url',
	    method: 'post',
	    data: {
	        values: {
	            pageNum : pageNum,
	            timestamp:''
	        }
	    }
	},function(ret, err){
	    if (ret) {
	        <!--有数据返回  -->
	        if(ret.code == 1){
	            var dataTpl = doT.template(document.getElementById("data-tpl").innerHTML);
	            <!-- 判断有无更多 -->
	            if(ret.count < 20) {
	                <!-- 暂无更多 -->
	                return;
	            }
	            <!--根据业务需求，一般用在数据容器有加载提示时候  -->
	            if(page == 1){
	                document.getElementById("data-list").innerHTML = '';
	            }
	            if(type == 'up'){
	                page ++;
	
	                document.getElementById("data-list").insertAdjacentHTML('beforeend', dataTpl(ret.data));
	            }else if(type == 'down'){
	                <!-- 插入在数据前面 -->
	                document.getElementById("data-list").insertAdjacentHTML('beforeBegin', dataTpl(ret.data));
	                <!-- 控制滚动条回到顶部 -->
	                api.pageUp({
	                    top:true
	                },function(ret, err) {
	                });
	            }
	        
	        }else{
	            <!-- 错误处理 -->
	        }
	    }
	});
}


表单数据提交

正则验证（正则表达式）

过滤表情-（如果含有文字算通过，否则提交失败）



图片上传

头像：

api.actionSheet({
​    title: '请选择照片',
​    cancelTitle: '取消',
​    buttons: ['拍照', '照片库']
}, function(ret, err) {
   api.getPicture
});

api.getPicture




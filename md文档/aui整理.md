## 布局容器

.aui-content和.aui-content-padded	建议在所有外层容器中使用.aui-content

.aui-content-padded有0.75rem(15px)的外边距

***

## 文本样式

.aui-text-default	#212121

.aui-text-primary	#00bcd4

.aui-text-success	#009688

.aui-text-info		#03a9f4

.aui-text-warning	#ffc107

.aui-text-danger	#e51c23

.aui-text-pink		#e97e63

.aui-text-purple	#673ab7

.aui-text-indigo		#3f51b5

```
<section class="aui-content-padded">
	<div class="aui-content">
		内容区域
	</div>
</section>
```

***

## 导航栏

当导航栏中只有中间文字或者tab等时，请不要使用.aui-title

```
//只有中间文字时，直接写
<header class="aui-bar aui-bar-nav">顶部导航栏</header>
//有其他的组成部分时，中间文字用.aui-title
<header class="aui-bar aui-bar-nav aui-bar-light">
	<a class="aui-pull-left aui-btn">
		<span class="aui-iconfont aui-icon-left"></span>
	</a>
	<div class="aui-title">Title</div>
	<a class="aui-pull-right aui-btn aui-btn-outlined">
		<span class="aui-iconfont aui-icon-search"></span>
	</a>
</header>
```

***

## 底部工具栏

aui-bar+aui-bar-tab组合实现，可以实现固定在底部的工具栏，可以结合aui-tab.js来使用

aui-bar-tab-item为子级元素

aui-active为选中时样式

```
<footer class="aui-bar aui-bar-tab">
	<div class="aui-bar-tab-item aui-active" tapmode>
		<i class="aui-iconfont aui-icon-home"></i>
		<div class="aui-bar-tab-label">首页</div>
	</div>
	<div class="aui-bar-tab-item" tapmode>
		<i class="aui-iconfont aui-icon-star"></i>
		<div class="aui-bar-tab-label">收藏</div>
	</div>
</footer>
```

***

## 按钮组工具栏

aui-bar+aui-bar-btn组合使用，结合aui-tab.js可以实现有切换功能的按钮组，也可以实现数字增减器效果

aui-bar-btn-item为子级容器

aui-bar+aui-bar-btn+aui-bar-btn-full	为满屏效果

aui-bar+aui-bar-btn+aui-bar-btn-sm	为小号按钮组

aui-bar+aui-bar-btn+aui-bar-btn-round	两侧为半圆形

在顶部导航使用时，当导航栏只有按钮组时，直接使用aui-bar-btn-item。如果还有其他图标，按钮组则需要放在aui-title容器中。

```
//无其他组成
<header class="aui-bar aui-bar-btn">
	<div class="aui-bar-btn-item aui-active">item</div>
	<div class="aui-bar-btn-item">item</div>
	<div class="aui-bar-btn-item">item</div>
</header>
//有其他组成
<header class="aui-bar aui-bar-btn">
	<a class="aui-pull-left" aui-btn>
		<span class="aui-icont aui-icon-left"></span>
	</a>
	<div class="aui-title">
		<div class="aui-bar-btn-item">item</div>
		<div class="aui-bar-btn-item">item</div>
		<div class="aui-bar-btn-item">item</div>
	</div>
</header>
```

***

## 信息条

​	信息条aui-info实现的效果在大多数APP中是比较常见的，在AUI中可以放在其他容器列表内使用。比如可以实现有头像，昵称，其他信息的横向布局样式。

默认使用垂直居中。

```
<div class="aui-info aui-margin-t-10 aui-padded-l-10 aui-padded-r-10">
	<div class="aui-info-item">
		<img src="../../image/demo.png" style="width:5rem class="aui-img-round"/><span class="aui-margin-l-5">AUI</span>
	</div>
	<div class="aui-ingo-item">2016-10-16 15:15</div>
</div>
```

***

## 按钮

aui-btn	默认按钮

aui-btn+aui-btn-primary	使用主题样式

aui-btn+aui-btn-block	使用块级按钮

aui-btn+aui-btn-outlined	使用边框按钮

aui-btn+aui-btn-block+aui-btn-sm	使用小号块级按钮

还有其他组合，可自行实验

常用按钮颜色：primary、success、info、warning、danger

```
<div class="aui-bontent-padded">
	<p>普通按钮</p>
	//primary对应的样式有各种颜色
	<p><div class="aui-btn aui-btn-primary">默认按钮(primary)</div></p>
	//图标按钮
	<p><div class="aui-btn-info"><span class="aui-iconfont aui-icon-edit"></span>图标按钮</div></p>
	<p><div class="aui-btn aui-btn-info">图标按钮</div></p>
	//块级按钮
	<p><div class="aui-btn aui-btn-block">默认按钮(default)</div></p>
	<p><div class="aui-btn aui-btn-primary aui-btn-block">默认按钮(primary)</div></p>
	//outlined按钮
	<p><div class="aui-btn aui-btn-primary aui-btn-outlined">默认按钮(primary)</div></p>
	//sm小按钮
	<p><div class="aui-btn aui-btn-primary aui-btn-sm">默认按钮(primary)</div></p>
	//sm outlined按钮
	<p><div class="aui-btn aui-btn-primary aui-btn-outlined aui-btn-sm">默认按钮(primary)</div></p>
```

***

## 标签/角标/圆点

aui-label	同按钮一样，提供了几个色值

aui-label+aui-label-primary	使用主题样式

aui-badge		右上角浮动角标

aui-dot	右上角圆点

```
//标签
<section class="aui-content-padded">
	<p>标签</p>
	默认：<div class="aui-label">标签</div>
	<Br/>
	info:<div class="aui-label aui-label-info">标签</div>
	<Br/>
</section>
//角标
<section class="aui-content-padded">
	<p>角标</p>
	<div class="aui-badge">88</div></Br>
</section>
//红点
<section class="aui-content-padded">
	<p>红点</p>
	dot:<div class="aui-dot"></div>
</section>
```

***

## 列表布局

aui-list为简单的列表布局容器，结合aui-media-list、aui-form-list、aui-select-list，可以实现媒体列表布局，表单及选择器列表。

###### 简单列表布局结构

```
aui-list
	aui-list-header
	aui-list-item
		aui-list-item-inner
			aui-list-item-title
```

aui-list+aui-list-in列表内下划线缩进

aui-list-item-inner+aui-list-item-arrow显示右侧箭头

###### 右侧带有其他的列表

```
aui-list
	aui-list-header
	aui-list-item
		aui-list-item-inner
			aui-item-title		aui-list-item-right
```

aui-list-item-right内可以放置各类组件，如开关、选择器、标签、环东条、按钮组工具栏、range等

###### 带有图标的列表布局

```
aui-list
	aui-list-header
	aui-list-item
		aui-list-item-label-icon	aui-list-item-inner
								  	aui-list-item-title
```

示例代码

```
//简单的列表布局
<div class="aui-content aui-margin-b-15">
	<ul class="aui-list aui-list-in">
		<li class="aui-list-header">
			简单的列表布局
		</li>
		<li class="aui-list-item">
			<div class="aui-list-item-inner">
				<div class="aui-list-item-title">item1</div>
			</div>
		</li>
	</ul>
</div>
//右侧带有箭头的列表布局
<div class="aui-content aui-margin-b-15">
	<ul class="aui-list aui-list-in">
		<li class="aui-list-header">
			带有右侧箭头
		</li>
		<li class="aui-list-item aui-list-item-middle">
			<div class="aui-list-item-inner aui-list-item-arrow">
				<div class="aui-list-item-title">item</div>
			</div>
		</li>
	</ul>
</div>
```

***

## 媒体列表

媒体布局aui-media-list是与aui-list结合使用的一种形式，可以实现有图片、多行文字等布局样式，结合栅格系统可以实现更多布局效果

###### 媒体列表完整布局

```
aui-list aui-media-list
	aui-list-header
	aui-list-item
		aui-media-list-item-inner
			aui-list-item-media		aui-list-item-inner
	aui-info
```

在媒体列表中加入aui-media-list-item-inner作为控制媒体的内容容器，主要为了弹性不居中兼容低端机型和容器内放置其他组件。

```
<div class="aui-content aui-margin-b-15">
    <ul class="aui-list aui-media-list">
      <li class="aui-list-item">
                  <div class="aui-media-list-item-inner">
                      <div class="aui-list-item-media">
                          <img src="../../image/demo1.png">
                      </div>
                      <div class="aui-list-item-inner">
                          <div class="aui-list-item-text">
                              <div class="aui-list-item-title">带有媒体的列表二</div>
                              <div class="aui-list-item-right">08:00</div>
                          </div>
                          <div class="aui-list-item-text">
                              在下方我们加入了aui-info信息条
                          </div>
                      </div>
                  </div>
       </li>
    </ul>
</div>
```



###### 带有其他信息的媒体列表布局结构

```
aui-list aui-media-list
	aui-list-header
	aui-list-item
		aui-media-list-item-inner
			aui-list-item-media		aui-list-item-inner
								      aui-list-item-title
								      aui-list-item-text
								      aui-info(信息条)
	aui-info(信息条)
```

示例代码

```
<div class="aui-content aui-margin-b-15">
	<ul class="aui-list aui-media-list">
		 <li class="aui-list-item">
            <div class="aui-media-list-item-inner">
                <div class="aui-list-item-media">
                    <img src="../../image/demo1.png">
                </div>
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-text">
                        <div class="aui-list-item-title">带有媒体的列表二</div>
                        <div class="aui-list-item-right">08:00</div>
                    </div>
                    <div class="aui-list-item-text">
                        在下方我们加入了aui-info信息条
                    </div>
                </div>
            </div>
            <div class="aui-info" style="padding-top:0">
                <div class="aui-info-item">
                    <img src="../../image/demo.png" style="width:1rem" class="aui-img-round" /><span class="aui-margin-l-5">赵发昊</span>
                    </div>
                <div class="aui-info-item">2016-10-16 18:31</div>
            </div>
        </li>
	</ul>
</div>
```

***

## 表单

aui-form-list是与aui-list结合实现的表单列表的布局形式

###### 表单列表布局

```
aui-list+aui-form-list
	aui-list-header
	aui-list-item
		aui-list-item-inner
			aui-list-item-label或		aui-list-item-input
			aui-list-item-label-icon
	aui-list-item
		aui-list-item-inner+aui-list-item-btn
```

表单列表中aui-list-item-label或aui-list-item-label-icon可以放置在aui-list-item-inner内部或外面

###### 表单列表布局

```
aui-list+aui-form-list
	aui-list-header
	aui-list-item
		aui-list-item-label或		aui-list-item-inner
		aui-list-item-label-icon		aui-list-item-input
	aui-list-item
		aui-list-item-inner+aui-list-item-btn
```

表单列表中aui-list-item-label或aui-list-item-label-icon可以放置在aui-list-item-inner内部或外部。

示例代码

```
<div class="aui-content aui-margin-b-15">
	<ul class="aui-list aui-form-list">
		<li class="aui-list-header">带有输入框</li>
		//输入框
		<li class="aui-list-item">
			<div class="aui-list-item-inner">
				<div class="aui-list-item-label">
					Text
				</div>
				<div class="aui-list-item-input">
					<input type="text" placeholder="Name">
				</div>
			</div>
		</li>
		//选项
		<li class="aui-list-item">
			<div class="aui-list-item-inner">
				<div class="aui-list-item-label">
					Radio
				</div>
				<div class="aui-list-item-input">
					<label><input class="aui-radio" type="radio" name="demo1" checked>选项一</label>
					<label><input class="aui-radio" type="radio" name="demo1">选项二</label>
				</div>
			</div>
		</li>
		//带有选项卡
		<li class="aui-list-item">
			<div class="aui-list-item-inner">
				<div class="aui-list-item-label">
					Select
				</div>
				<div class="aui-list-item-input">
					<select>
						<option>Option1</option>
						<option>Option2</option>
						<option>Option3</option>
					</select>
				</div>
			</div>
		</li>
		//switch开关
		<li class="aui-list-item">
			<div class="aui-list-item-inner">
				<div class="aui-list-item-label">
					Switch
				</div>
				<div class="aui-list-item-input">
					<input type="checkbox" class="aui-switch" checked/>
				</div>
			</div>
		</li>
		//range
		<li class="aui-list-item">
			<div class="aui-list-item-inner">
				<div class="aui-list-item-label">
					Range
				</div>
				<div class="aui-list-item-input">
					<div class="aui-range">
						<input type="range" class="aui-range" value="30" max="100" min="1" step="1" id="range"/>
					</div>
				</div>
			</div>
		</li>
		//文本区域
		<li class="aui-list-item">
			<div class="aui-list-item-inner">
				<div class="aui-list-item-label">
					Textarea
				</div>
				<div class="aui-list-item-input">
					<textarea placeholder="Textarea"/>
				</div>
			</div>
		</li>
	</ul>
</div>
```

***

## 选择器列表

aui-select-list和aui-list结合可以实现带有选择器的列表布局样式

###### 选择器列表布局

```
aui-list+aui-select-list
	aui-list-header
	aui-list-item
		aui-list-item-label		aui-list-item-inner
```

示例代码

```
<div class="aui-content aui-margin-b-15">
	<ul class="aui-list aui-select-list">
		<li class="aui-list-header">带有单选或者多选框的列表</li>
		<li class="aui-list-item">
			<div class="aui-list-item-label">
				<input class="aui-radio" type="radio" name="radio" checked>
			</div>
			<div class="aui-list-item-inner">
				这是一个列表项
				<div class="aui-list-item-text">
					这里是内容区域
				</div>
			</div>
		</li>
	</ul>
</div>
```

***

卡片列表

卡片列表在APP中是比较常见的布局样式，可以结合**栅格系统**实现漂亮的布局，如知乎页面。

###### 卡片列表布局

```
aui-card-list
	aui-card-list-header
	aui-card-list-content或aui-card-list-content-padded
	aui-card-list-footer
```

示例代码

```
//普通卡片布局
<section class="aui-content-padded">
	<div class="aui-card-list">
		<div class="aui-card-list-header">
			卡片布局头部区域
		</div>
		<div class="aui-card-list-content-padded">
			内容区域，卡片列表可以实现常见APP样式
		</div>
		<div class="aui-card-list-footer">
			底部区域
		</div>
	</div>
</section>

//普通带图片卡片布局
<section class="aui-content">
	<div class="aui-card-list">
		<div class="aui-card-list-header">
			卡片布局头部区域
		</div>
		<div class="aui-card-list-content">
			<img src="../../image/demo.png"/>
		</div>
		<div class="aui-card-list-footer">
			2016年10月16日
		</div>
	</div>
</section>

//点赞类型的卡片布局
<section class="aui-content">
	<div class="aui-card-list">
		<div class="aui-card-list-header">
			卡片布局头部区域
		</div>
	</div>
	<div class="aui-card-list-content-padded aui-border-b aui-border-t">
		<div class="aui-row aui-row-padded">
            <div class="aui-col-xs-4">
                <img src="../../image/11.png">
            </div>
            <div class="aui-col-xs-4">
                <img src="../../image/12.png">
            </div>
            <div class="aui-col-xs=4">
                <img src="../../image/13.png">
            </div>
         </div>
	</div>
	<div class="aui-card-list-footer">
		<div><i class="aui-iconfont aui-icon-star"></i></div>
		<div><i class="aui-iconfont aui-icon-laud"></i></div>
		<div><i class="aui-iconfont aui-icon-note"></i></div>
	</div>
</section>

//qq空间类型卡片布局
<section class="aui-content">
	<div class="aui-card-list">
		<div class="aui-card-list-header aui-card-list-user aui-border-b">
			<div class="aui-card-list-user-avatar">
				<img src="../../image/demo4.png" class="aui-img-round"/>
			</div>
			<div class="aui-card-list-user-name">
				<div>AUI</div>
				<small>一天前</small>
			</div>
			<div class="aui-var-list-user-info">北京朝阳</div>
			</div>
			<div class="aui-card-list-content-padded">
				<img src="../../image/12.png"/>
			</div>
			<div class="aui-card-list-footer aui-border-t">
				<div><i class="aui-iconfont aui-icon-note"></i> 666</div>
				<div><i class="aui-iconfont aui-icon-laud"></i> 888</div>
				<div><i class="aui-iconfont aui-icon-star"></i> 888</div>
			</div>
		</div>
	</div>
</section>

//最近联系人类型卡片布局
<section class="aui-content">
	<div class="aui-card-list">
		<div class="aui-card-list-header">
			<div><i class="aui-iconfont aui-icon-my aui-text-danger"></i><span class="aui-text-danger">最近联系人</span></div>
		</div>
		<div class="aui-card-list-content">
			<ul class="aui-list aui-media-list">
				<li class="aui-list-item aui-list-item-middle">
					<div class="aui-media-list-item-inner">
						<div class="aui-list-item-media">
							<img src="../../image/demo.png" class="aui-img-round aui-list-img-sm">
						</div>
						<div class="aui-list-item-inner aui-list-item-arrow">
							<div class="aui-list-item-text">
								<div class="aui-list-item-title aui-font-size-14">AUI</div>
								<div class="aui-list-item-right">08:00</div>
							</div>
							<div class="aui-list-item-text">
								www.auicss.com
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<div class="aui-card-list-footer aui-text-center">
			查看更多
		</div>
	</div>
</section>
```

***

## 弹出菜单

​	aui-popup为弹出菜单样式，结合aui-popup.js来使用控制。弹出菜单考虑到用户的自定义性，并**没有封装到js里面**，js里面只是关联了弹出效果。需要给按钮增加aui-popup-for='弹出层容器id'属性来关联弹出菜单。

具体效果参考代码：

```
<section class="aui-content-padded">
	<div class="aui-btn aui-btn-primary">左上角</div>
	<div class="aui-btn aui-btn-primary">顶部中间</div>
	<div class="aui-btn aui-btn-primary">右上角</div>
</section>
<section class="aui-content-padded">
	<div class="aui-btn aui-btn-info" aui-popup-for="bottom-left">左下角</div>
	<div class="aui-btn aui-btn-info" aui-popup-for="bottom">底部中间</div>
	<div class="aui-btn aui-btn-info" aui-popup-for="bottom-right">右下角</div>
</section>
<div class="aui-popup-top-left" id="top-left">
	<div class="aui-popup-arrow"></div>
	<div class="aui-popup-content">
		<ul class="aui-list aui-list-noborder">
			<li class="aui-list-item">
				<div class="aui-list-item-label-icon">
					<i class="aui-iconfont aui-icon-my aui-text-warning"></i>
				</div>
				<div class="aui-list-item-inner aui-list-item-middle">
					会员中心
				</div>
			</li>
			<li class="aui-list-item">
				<div class="aui-list-item-label-icon">
					<i class="aui-iconfont aui-icon-mail aui-text-icon"></i>
				</div>
				<div class="aui-list-inner">
					会话消息
				</div>
			</li>
			<li class="aui-list-item">
				<div class="aui-list-item-label-icon">
					<i class="aui-iconfont aui-icon-star aui-text-danger"></i>
				</div>
				<div class="aui-list-inner">
					我的收藏
				</div>
			</li>
		</ul>
	</div>
</div>

```

**代码过长，详情请见auicss.com**

***

## 栅格系统

栅格系统采用**12等分**布局

aui-row栅格外层容器，子级无间距

aui-row-padded，栅格外层容器，子级又兼具

aui-col-xs-(1-12)

默认12等分布局中无法实现5等分，为此加入了**aui-col-5**为实现五等分效果。

## 宫格布局

宫格布局是**结合栅格系统**实现的一种布局方式

aui-grid宫格容器

```
<sction class="aui-grid aui-margin-b-15">
	<div clas="aui-row">
		<div class="aui-col-xs-4">
			<div class="aui-badge">88</div>
			<i class="aui-iconfont aui-icon-home"></i>
			<div class="aui-grid-label">首页</div>
		</div>
		<div class="aui-col-xs-4">
			<i class="aui-iconfont aui-icon-gear"></i>
			<div class="aui-grid-label">设置</div>
		</div>
		<div class="aui-col-xs-4">
			<i class="aui-iconfont aui-icon-map"></i>
			<div class="aui-grid-label">地图</div>
		</div>
		<div class="aui-col-xs-4">
			<i class="aui-iconfont aui-icon-date"></i>
			<div class="aui-grid-label">日期</div>
		</div>
		<div class="aui-col-xs-4">
			<i class="aui-iconfont aui-icon-calendar"></i>
			<div class="aui-grid-label">日历</div>
		</div>
		<div class="aui-col-xs-4">
			<div class="aui-dot"></div>
			<i class="aui-iconfont aui-icon-cart"></i>
			<div class="aui-grid-label">购物车</div>
	</div>
</section>
```

***

## 搜索框

```
<div class="aui-searchbar" id="search">
	<div class="aui-searchbar-input aui-border-radius" tapmode onclick="doSearch()">
		<i class="aui-iconfont aui-icon-search"></i>
		<form action="javascript:search()">
			<input type="search" placeholder="请输入搜索内容" id="search-input">
		</form>
	</div>
	<div class="aui-searchbar-cancel" tapmod>取消</div>
</div>
```

***

## 进度条

aui-progress默认

aui-progerss-sm小号

aui-progress-xs特小

aui-progerss-xxs极小

```
<div class="aui-content-padded">
	<p>.aui-progress</p>
	<div class="aui-progress aui-progress">
		<div class="aui-progress-bar" style="width:60%"></div>
	</div>
	<p>.aui-progress-sm</p>
	<div class="aui-progress aui-progress-sm">
		<div class="aui-progress-bar" style="width:60%"></div>
	</div>
	<p>.aui-progress-xs</p>
	<div class="aui-progress aui-progress-xs">
		<div class="aui-progress-bar" style="width:60%"></div>
	</div>
</div>
```

***

## Toast

参考《JS组件aui-toast》使用方法

```
<div class="aui-content-padded">
	<div class="aui-btn aui-btn-block aui-btn-info" tapmode onclick="showDefault('success')">默认样式(toast)</div>
	<div class="aui-btn aui-btn-block aui-btn-success" tapmode onclick="showDefault('fail')">失败(toast)</div>
	<div class="aui-btn aui-btn-block aui-btn-success" tapmode onclick="showDefault('custom')">自定义</div>
	<div class="aui-btn aui-btn-block aui-btn-warning" tapmode onclick="shouDefault('loading')">弹出loading样式(toast)</div>
</div>
<script type="text/javascript" src="../../script/aui-toast.js"></script>
<script type="text/javascript">
	apiready = function(){
      	api.parseTapmode();
	}
	var toast = new auiToast({});
	function shouDefault(type){
      	switch(type){
          	case "success":
          		toast.success({
                  	title:"提交成功",
                  	duration:2000
          		});
          		break;
          	case "fail":
          		toast.fail({
                  	title:"提交失败",
                  	durition:2000
          		});
          		break;
          	case "custom":
          		toast.custom({
                  	title:"提交成功",
                  	html:'<i class="aui-iconfont aui-icon-laud"></i>',
                  	duration:2000
          		});
          		break;
          	case "loading":
          		toast.loading({
                  	title:"加载中",
                  	duration:2000
          		},function(ret){
                  	console.log(ret);
                  	setTimeout(function(){
                      toast.hide();
                  	},3000),
          		});
          		break;
          	default:
          		break;
      	}
	}
</script>
```

***




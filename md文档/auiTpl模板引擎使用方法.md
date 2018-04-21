## aui-tpl.js

auiTpl为模板渲染引擎，简单易用，快速渲染；解决了拼接字符串形式的构造。

auiTpl优点：

​	1、体积小，渲染速度快，只有1kb

​	2、采用后端语法书写形式

​	3、支持模板嵌套

​	4、支持模板内js方法及回调处理

​	5、模板内使用原生js进行数据处理

代码示例：

1、引入

```js
<script type="text/javascript" src="aui-tpl.js"></script>
```

2、使用，view为要呈现模板的容器，#tpl为模板容器

```javascript
document.getElementById('view').innerHTML = auiTpl('#tpl', data);
```

3、数据呈现

开始标签 <#

结束标签 #>

```html
<#=title#>
```

在开始开始标签和结束标签内直接写javascript语法进行逻辑处理。

使用案例：

```html
<div id="view">
	<!-- 这里要展示模板的容器 -->
</div>
<script type="text/aui-template" id="tpl">
	<!-- 模板 -->
    <h1><#=title#></h1>
    <p><#=description#></p>
    <#for(var i in data){#>
    <p><#=data[i].title#></p>
    <p><#=data[i].time#></p>
    <#}#>
</script>
<script type="text/javascript" src="aui-tpl.js"></script>
<script>
    var tplData = {
    	title:'AUI TPL',
    	description:'这是一个快速渲染的模板引擎',
    	data:[{
    		title:'AUI模板引擎发布啦',
    		time:'2017-04-21 08:00'
    	},{
    		title:'让布局更快速，免去拼接字符烦恼',
    		time:'2017-04-21 08:00'
    	}]
    }
    document.getElementById('view').innerHTML = auiTpl('#tpl', tplData);
</script>
```

为了方便扩展及逻辑处理，auiTpl支持模板内使用inTpl方法嵌套模板

代码示例

```html
<div id="view">
	<!-- 这里要展示模板的容器 -->
</div>
<script type="text/aui-template" id="tpl">
	<!-- 模板 -->
    <h1><#=title#></h1>
    <!-- 要嵌套的模板 -->
    <p><#inTpl('#tpl_job');#></p>
    <#for(var i in data){#>
    <p><#=data[i].title#></p>
    <p><#=data[i].time#></p>
    <#}#>
</script>
<script type="text/aui-template" id="desc-tpl">
    <p><#=description#></p>
</script>
<script type="text/javascript" src="aui-tpl.js"></script>
<script>
    var tplData = {
    	title:'AUI TPL',
    	description:'这是一个快速渲染的模板引擎',
    	data:[{
    		title:'AUI模板引擎发布啦',
    		time:'2017-04-21 08:00'
    	},{
    		title:'让布局更快速，免去拼接字符烦恼',
    		time:'2017-04-21 08:00'
    	}]
    }
    document.getElementById('view').innerHTML = auiTpl('#tpl', tplData);
</script>
```

for循环使用，注意花括号的闭合

```html
<#for(var i in data){#>
  <p><#=data[i].title#></p>
  <p><#=data[i].time#></p>
<#}#>
```

或

```html
<#for(var i=0;i<data.length;i++){#>
  <p><#=data[i].title#></p>
  <p><#=data[i].time#></p>
<#}#>
```

if判断，注意花括号的闭合

```html
<#if(id==0){#>
  <!-- 逻辑处理-->
<#}#>
```

模板内使用函数，如下面的方法会出现alert弹窗

```html
<#alert('这是一个弹出');#>
```

模板内使用函数的回调，如下方法，模板内会输入func方法的return值

```html
<#=func();#>
<script>
  function func(){
    return "这是一个回调";
  }
</script>
```


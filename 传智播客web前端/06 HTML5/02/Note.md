# 2015年12月03日

# Markdown

> 用普通文本描述富文本的语法
> 扩展名md,markdown

# HTML5之HTML篇回顾

1. 新标签
    1. 语义化标签
2. 新属性
    1. 链接关系描述
    2. ARIA 无障碍富互联网应用程序属性
    3. 自定义属性 data-
        1. 可以给HTML里的所有DOM对象都可以添加一些DATA-xxx的属性
        2. 用来记录与当前DOM强相关的数据
3. 智能表单
    1. 新的表单类型
        1. 功能型的表单类型
    2. 虚拟键盘适配
        1. 通过type方式指定弹出键盘
4. 网页多媒体
    1. 之前强依赖flash 
    2. 音频
    3. 多媒体的dom对象有一些新的方法可以去做播放暂停
    3. 视频
    4. 了解字幕
5. SVG 文件基本使用
    1. iframe
        1. iframe的作用就是在网页中挖个坑，在这个坑里再展示一个页面
        2. svg本身也是文档 所以可以使用iframe的方式载入
    2. ajax 直接可以修改样式 

# JavaScript

## 2.1. 基础API提升

### 2.1.1 新选择器

JS多了一个原始支持，类似jqueryDOM选择器

document.getElementById() 需要给DOM元素设置ID
document.querySelector(selector) 可以通过CSS选择器的语法找到DOM元素

document.getElementsByTagName()
document.querySelectorAll('.item')

$('.item').on

1. document.querySelector(selector); 
2. 返回第一个满足选择器条件的元素 一个dom对象
3. document.querySelectorAll('.item');
4. 返回所有满足该条件的元素 一个元素类型是dom类型的数组
5. $('.item')
6. 返回一个jQuery对象（dom元素的数组）
7. 本质上jquery方式和qs方式都是获取DOM数组， 只不过jquery会多一些其他成员
8. DOM数组的每一个成员注册事件不能像jquery一样直接注册， 必须分别给每个元素注册
9. h5就是将我们经常需要的操作又包装一层


### 2.1.2 元素.classList

1. 新H5中DOM对象多了一个classList属性，是一个数组
2. add 添加一个新的类名
3. remove 删除一个的类名
4. contains 判断是否包含一个指定的类名 
5. toggle 切换一个class element.toggle('class-name',[add_or_remove])
6. toggle函数的第二个参数true为添加 false删除


### 2.1.3 访问历史 API

界面上的所有JS操作不会被浏览器记住，就无法回到之前的状态
在HTML5中可以通过window.history操作访问历史状态，让一个页面可以有多个历史状态

1. window.history.forward(); // 前进
2. window.history.back(); // 后退
3. window.history.go(); // 刷新
4. 通过JS可以加入一个访问状态
4. history.pushState(放入历史中的状态数据, 设置title(现在浏览器不支持)， 改变历史状态)

### 2.1.4 全屏 API

> JavaScript中可以通过调用requestFullScreen()方式实现指定元素的全屏显示
> var element = document.querySelector('...');
> element.requestFullScreen();
> 

## 2.2 网页存储

### 2.2.1 Web Storage

1. getItem方式获取一个不存在的键 返回空字符串
2. []返回 undefined

### 2.2.2 Web SQL

### 2.2.3 IndexedDB

## 2.3 文件系统

### 2.3.1 File API

### 2.3.2 FileReader

## 2.4 拖放操作

### 2.4.1 网页内拖放

### 2.4.2 文件拖入
# Flexbox演示站 [地址](https://xluos.github.io/demo/flexbox/)

可以通过动态的点击flexbox属性可以实时看到各个属性的效果，有助于理解各个属性。

友好的提示，鼠标放在选项上面悬停显示各个属性效果。


# Flexbox布局各种属性速查表

# 容器属性

## `flex-direction`主轴方向(交叉轴永远是 主轴的顺时针90°的方向)
+ `row`（默认值）：主轴为水平方向，起点在左端。
+ `row-reverse`：主轴为水平方向，起点在右端。
+ `column`：主轴为垂直方向，起点在上沿。
+ `column-reverse`：主轴为垂直方向，起点在下沿。
## `flex-wrap`轴线是否换行
+ `nowrap`（默认）：不换行
+ `wrap` : 换行，第一行在上方
+ `wrap-reverse` : 换行，第一行在下方
## `flex-flow`前两个属性的简写形式，默认值为`row` `nowrap`
## `justify-content`: 定义了项目在主轴上的对齐方式
+ `flex-start`（默认值）：左对齐
+ `flex-end`：右对齐
+ `center`： 居中
+ `space-between`：两端对齐(左右两端)，项目之间的间隔都相等(项目之间间隔  远大于  最两侧项目与边框的距离)。
+ `space-around`：每个项目两侧的间隔相等。所以，项目之间的间隔比项目与边框的间隔大一倍。
## `align-items`: 定义项目在交叉轴上如何对齐。
+ `flex-start`：交叉轴的起点对齐。
+ `flex-end`：交叉轴的终点对齐。
+ `center`：交叉轴的中点对齐。
+ `baseline`: 项目的第一行文字的基线对齐。
+ `stretch`（默认值）：如果项目未设置高度或设为auto，将占满整个容器的高度。
## `align-content`属性定义了多根轴线的对齐方式。如果项目只有一根轴线，该属性不起作用
+ `flex-start`：与交叉轴的起点对齐。
+ `flex-end`：与交叉轴的终点对齐。
+ `center`：与交叉轴的中点对齐。
+ `space-between`：与交叉轴两端对齐，轴线之间的间隔平均分布。
+ `space-around`：每根轴线两侧的间隔都相等。所以，轴线之间的间隔比轴线与边框的间隔大一倍。
+ `stretch`（默认值）：轴线占满整个交叉轴。
# 项目属性

## `order`属性定义项目的排列顺序。数值越小，排列越靠前，默认为0
## `flex-grow`属性定义项目的放大比例，默认为0，即如果存在剩余空间，也不放大。剩余空间分配的比例是项目这个元素占总值的比例【用来“瓜分”父项的“剩余空间”】
## `flex-shrink`属性定义了项目的缩小比例，默认为1，即如果空间不足，该项目将缩小，于上一个相同，空间不足时按所占的比例缩小【用来“吸收”超出的空间】
## `flex-basis`属性定义了在分配多余空间之前，项目占据的主轴空间。它决定主轴的大小浏览器根据这个属性来判断主轴还有多少剩余空间，默认auto 【用于设置子项的占用空间】
## `flex`属性是`flex-grow`, `flex-shrink` 和 `flex-basis`的简写，默认值为`0 1 auto`。该属性有两个快捷值：`auto (1 1 auto)` 和 `none (0 0 auto)`
## `align-self`允许不一样的对齐方式，可覆盖`align-items`属性。默认值为`auto`继承父元素的`align-items`属性

# 细节问题自己整理

项目属性之 flex 简单介绍

```css
/**
flex 取值的各种情况(每种情况的写法互为等效)
*/
情况1  flex 的默认值 0 1 auto
.item{flex: 0 1 auto};
.item{
    flex-grow:0;
    flex-shrink:1;
    flex-basis:auto;
}
情况2 felx取值none  0 0 auto
.item{flex:none}
.item{
    flex-grow:0;
    flex-shrink:0;
    flex-basis:auto;
}
情况3 flex取值auto  1 1 auto
.item{flex:auto}
.item{
    flex-grow:1;
    flex-shrink:1;
    flex-basis:auto;
}
情况4 flex取值为非负数字 则该数字为flex-grow值，例如flex-shrink取1 flex-basis取0%;[0%是百分比 不是非负数字]
.item{flex:1}
.item{
    flex-grow:1;
    flex-shrink:1;
    flex-basis:0%;
}
情况5 flex取值为长度或百分比 则视为flex-basis值 例如flex-grow取1 flex-sharink取1
.item{flex:0%}
.item{
    flex-grow:1;
    flex-shrink:1;
    flex-basis:0%;
}

.item{flex:24px}
.item{
    flex-grow:1;
    flex-shrink:1;
    flex-basis:24px;
}
情况6 flex取值为两个非负数字 则分别视为 flex-grow和 flex-shrink的值 例如 flex-basis取0%;
.item{flex:2 3}
.item{
    flex-grow:2;
    flex-shrink:3;
    flex-basis:0%;
}
情况7 flex取值为一个非负数字和一个长度或百分比 则分别视为flex-grow和 flex-basis的值 例如flex-shrink取1
.item{flex:2 200px}
.item{
    flex-grow:2;
    flex-shrink:1;
    flex-basis:200px;
}

```


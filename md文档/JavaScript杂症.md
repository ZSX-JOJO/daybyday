# 44道JavaScript难题

## 1.

## ["1", "2", "3"].map(parseInt)

参考链接:

https://developer.mozilla.org/zh-CN/docs/Web/JavaScript/Reference/Global_Objects/parseInt

https://developer.mozilla.org/zh-CN/docs/Web/JavaScript/Reference/Global_Objects/Array/map

https://segmentfault.com/a/1190000007347119

```javascript
/**
输出 [0,NAN,NAN]
*/

/**
parseInt(string,radix) 
string: 要解析的字符串 
radix: 进制(2~36之间的整数) 0代表十进制 (ECMAScript 5 规定使用 10)
栗子:
parseInt('123', 5) // 将'123'看作5进制数，返回十进制数38 => 1*5^2 + 2*5^1 + 3*5^0 = 38

parseInt(021,8) ==>15 
021 代表8进制应该先转换为10进制 为 17 ==>parseInt(17,8) 1*8 + 7*1 = 15

parseInt(21,8) ==>17  2*8 + 1*1 = 17 


map 方法会给原数组中的每个元素都按顺序调用一次 callbak 函数;回调函数会自动传入三个参数:正在遍历的数组元素,元素索引,原数组本身
*/

/**
解析：
     map 能传进回调函数 3参数 (element, index, array)
     parseInt('1', 0);  //0代表10进制
     parseInt('2', 1);  //没有1进制，不合法
     parseInt('3', 2);  //2进制根本不会有3
巩固：["1", "1", "11","5"].map(parseInt) 
[1, NaN, 3, NaN]  
*/
```

## 2.

## [typeof null, null instanceof Object]

```javascript
答案:
["object", false]
/**
null 只有一个值的特殊类型,表示一个空对象引用. typeof 返回object
undefined是一个没有设置值的变量. typeof 返回undefined
*/
typeof undefined             // undefined
typeof null                  // object
null === undefined           // false
null == undefined            // true

/**
instanceof 详解:
语法:
object instanceof constructor (constructor构造函数)
解析:
object 要检测的对象  constructor 某个构造函数
[instanceof 运算符用来测试一个对象在其原型链中是否存在一个构造函数的 prototype 属性]
or
[instanceof 运算符用来检测 constructor.prototype 是否存在于参数 object 的原型链上] !!!!

*/
```

## 3.

## [[3,2,1].reduce(Math.pow), [].reduce(Math.pow) ]

```javascript
/**
改写为:

var numbers = [3,2,1];
function get(total,num){ 
	return Math.pow(total,num);
}
console.log(numbers.reduce(get));

答案：9 error
解析：
	语法:
	array.reduce(function(total, currentValue, currentIndex, arr), initialValue);
		function(total, currentValue, currentIndex, arr)
			total:必需.初始值,,或者计算结束后的返回值.
			currentValue:必需。当前元素.
			currentIndex:可选.当前元素的索引.
			arr:可选.当前元素所属的数组对象.
		initialValue:可选.传递给函数的初始值.
reduce() 方法接收一个函数作为累加器，数组中的每个值（从左到右）开始缩减(具体运算根据函数而定)，最终计算为一个值

Math.pow (x , y)  x 的 y 次幂的值
如果一个函数不传初始值，数组第一个组默认为初始值.
[3,2,1].reduce(Math.pow)
Math.pow(3,2) //9
Math.pow(9,1) //9
巩固：[].reduce(Math.pow)       //空数组会报TypeError
     [1].reduce(Math.pow)      //只有初始值就不会执行回调函数，直接返回1
     [].reduce(Math.pow,1)     //只有初始值就不会执行回调函数，直接返回1
     [2].reduce(Math.pow,3)    //传入初始值，执行回调函数，返回9 //初始值3 3^2 == 9
*/
```

## 4.

## var  val = 'smtg';  

## console.log('Value is ' + (val === 'smtg') ? 'Something' : 'Nothing'); 

关于运算符优先级

```javascript
var val = 'smtg';
console.log('Value is ' + (val === 'smtg') ? 'Something' : 'Nothing');
/**
答案：Something
解析：字符串连接比三元运算有更高的优先级 
     所以原题等价于 'Value is true' ? 'Somthing' : 'Nonthing' 
     而不是 'Value   is' + (true ? 'Something' : 'Nonthing')
*/
```

运算符优先级详解:[](https://juejin.im/post/5b1f899fe51d4506c60e46ee)

## 5.

## 变量提升 && 函数提升

```JavaScript
/**
变量提升
*/
//栗子1:
var name = 'World!';
(function () {
if (typeof name === 'undefined') {
    var name = 'Jack';//作用域问题 查看 "自用-收集整理.md" 作用域部分
    console.log('Goodbye ' + name);
} else {
    console.log('Hello ' + name);
}
})();
输出 Goodbye Jack

以上等价于 ==>
var name = 'World!';
(function () {
    var name;//变量提升了。
    if (typeof name === 'undefined') {// 程序进入到if 而不是else
        name = 'Jack';
        console.log('Goodbye ' + name);
    }else{
        console.log('Hello ' + name);
    }
})();
/**
解析:
1:
name 变量提升 typeof时 undefined
2:
typeof 优先级 高于 ===

变量声明总是会被解释器悄悄地被 “提升” 到方法体的最顶部。

变量提升 仔细查看是否存在 var "关键字" 以及作用域问题

函数提升在变量提升之上!!!!
*/

//栗子2:

console.log(global); // undefined
var global = 'global';
console.log(global); // global
 
function fn () {
　　console.log(a); // undefined
　　var a = 'aaa';
　　console.log(a); // aaa
}
fn();

等价于 ==>
var global; // 变量提升，全局作用域范围内，此时只是声明，并没有赋值
console.log(global); // undefined
global = 'global'; // 此时才赋值
console.log(global); // 打印出global
 
function fn () {
　　var a; // 变量提升，函数作用域范围内
　　console.log(a);
　　a = 'aaa';
　　console.log(a);
}
fn();

//栗子3:
(function() {
　　console.log(a);//a 只有声明 未被赋值 undefined
　　a = 'aaa';//变量没有提升 全局变量
　　var a = 'bbb'; 
　　console.log(a);//输出 bbb
})();

等价于 ==>
(function() {
   var a;
　　console.log(a);//a 只有声明 未被赋值 undefined
　　a = 'aaa';//变量没有提升 全局变量 此时 a == "aaa"
　　var a = 'bbb'; //局部变量 a == "bbb"
　　console.log(a);//输出 bbb
})();

/**
函数提升
*/
//js 中创建函数有两种方式：函数声明式和函数字面量式。只有函数声明才存在函数提升
console.log(f1); // function f1() {}   
console.log(f2); // undefined  
function f1() {}
var f2 = function() {}
等价于 ==>
function f1() {} // 函数提升，整个代码块提升到文件的最开始　　　　　
console.log(f1);   
console.log(f2);   //函数 f2 是函数字面量式 不会提升
var f2 = function() {}
/**
f1() {}
undefined
*/
foo();
var foo = function(){
    console.log("aaa");
}
相当于 ==>
var foo;
//console.log(foo);  //undefined
foo(); //foo is not a function
foo = function(){
    console.log("aaa");
}
/**
报错:foo is not a function
*/

console.log(foo+"空格"+"1111");
var foo=10;
console.log(foo+"空格"+"2222");
function foo(){
    console.log(10);
}
console.log(foo+"空格"+"3333");
等价于 ==>
function foo(){
    console.log(10);
}
var foo;
console.log(foo+"空格"+"1111");
foo=10;
console.log(foo+"空格"+"2222");
console.log(foo+"空格"+"3333");
/**
function foo(){
    console.log(10);
}空格1111

10空格2222

10空格3333
*/
/**
函数提升在变量提升上面，第一个 console.log(foo); 为什么会输出函数体呢，
原因在于 var foo; 并未有赋值只是声明，因此他会调用上面的值

函数提升 在 变量提升 之上
*/

//栗子1:
console.log(f1()+"第二个运行"); 
console.log(f2+"第三个运行");   
function f1() {console.log('aa'+"最先运行")}
var f2 = function() {}
/**
aa最先运行
undefined第二个运行
undefined第三个运行
*/
//栗子2:
foo();
function foo(){
    console.log("aaa");
}
等价于 ==>
function foo(){
    console.log("aaa");
}
foo();
/**
"aaa"
*/ 
    
```

## 6:

## 跳过

```JavaScript

```

## 7:

## var ary = [0,1,2]; 

## ary[10] = 10; 

## ary.filter(function(x) { return x === undefined;});  

```JavaScript
/**
Array的filter()方法
*/
var ary = [0,1,2]; 

ary[10] = 10; 

ary.filter(function(x) { return x === undefined;});
/**
[]

解析:
filter() 不会对空数组进行检测。
filter() 不会改变原始数组。
*/

```

## 8:

## toFixed()   //跳过

```javascript

```

## 9:

```JavaScript

```

## 10:

## 11:

## %  取余运算

```JavaScript
function isOdd(num) {
    return num % 2 == 1;
}
function isEven(num) {
    return num % 2 == 0;
}
function isSane(num) {
    return isEven(num) || isOdd(num);
}
var values = [7, 4, '13', -9, Infinity];
values.map(isSane);
/**
[true,true,true,false,false]
解析:
%如果不是数值会调用Number（）去转化
余数的正负号随 第一个操作数
*/
```

## 12:

## parseInt ()

```JavaScript
//parseInt(string, radix)  必需 要被解析的字符串,可选 要解析的数字的基数(介于2-36之间)
parseInt(3, 8)
parseInt(3, 2)
parseInt(3, 0)
/**
3 NaN 3
*/
```


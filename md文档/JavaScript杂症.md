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

## var  val = 'smtg'; console.log('Value is ' + (val === 'smtg') ? 'Something' : 'Nothing'); 

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
　　console.log("%c"+a,"color:red;font-size:20px"); // aaa  %c css格式化字符串
}
fn();

等价于 ==>
var global; // 变量提升，全局作用域范围内，此时只是声明，并没有赋值
console.log(global); // undefined
global = 'global'; // 此时才赋值
console.log(global); // 打印出global
 
function fn () {
　　var a; // 变量提升，函数作用域范围内
　　console.log(a); //undefined
　　a = 'aaa';
　　console.log(a); //aaa
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

## var two   = 0.2 ;var one   = 0.1 ;var eight = 0.8 ;var six   = 0.6 ;

## [two - one == one, eight - six == two] 

```javascript
/**
输出:[true,false]

解析:
四舍六入五成双
[two - one == one,(eight - six).toFixed(2) == two]; //若使用toFixed()方法 则输出[true,true]
*/
IEEE 754标准中的浮点数并不能精确地表达小数
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

## 19:

## 关于参数

```JavaScript
function sidEffecting(ary) {
  ary[0] = ary[2];
}
function bar(a,b,c) {
  c = 10
  sidEffecting(arguments);
  return a + b + c;
}
bar(1,1,1)
/**
输出:21

解析:
arguments会和函数参数绑定
*/
变种:
function sidEffecting(ary) {
    ary[0] = ary[2];
}
function bar(a=99,b,c) {
    c = 10
    sidEffecting(arguments);
    console.log("%c"+"a="+a,"color:red;font-size:12px");
	console.log("%c"+"b="+b,"color:yellow;font-size:14px");
	console.log("%c"+"c="+c,"color:blue;font-size:16px");
    return a + b + c;
}
bar(1,1,1)
/**
输出:
a=1
b=1
c=10

解析:
但如果es6付给初始值则无法修改
*/
```

## 20:

## JavaScript最大值

```JavaScript
/**在JavaScript中number类型在JavaScript中以64位（8byte）来存储。这64位中有符号位1位、指数位11位、实数位52位。2的53次方时，是最大值。其值为：9007199254740992（0x20000000000000）。超过这个值的话，运算的结果就会不对*/
```

## 21:

## reverse() 

```JavaScript
reverse() //颠倒数组中元素的顺序
```

## 22:

## MIN_VALUE 

```JavaScript
/**
表示JavaScript最小的值5 x 10-324,是Number对象的静态属性;Number.MIN_VALUE
*/
```

## 23:

```JavaScript
[1 < 2 < 3, 3 < 2 < 1]
/**
输出:
[true,true]

解析:
1 < 2 ==> true;
true < 3 ==> 1 < 3 ==> true

3 < 2 ==> false;
false < 1 ==> 0 < 1 ==> true
*/
```

## 24:

## 值和引用类型比较

```JavaScript
2 == [[[2]]]
/**
输出:
true

解析:
栗子1:

++[[]][+[]]+[+[]] //"10"

==>
++[[]][+[]] //+[] == 0
+
[+[]]
==>
++[[]][0] //[[]][0] === [[]] 此种表示方法不太正确
+
[0]
==>
+([] + 1) //In JavaScript, this is true as well:  [] == "";[] + 1 === "1" 
+
[0] //this is true in JavaScript: [0] == "0"
==>
+("1") // +("1") === 1
+
"0"
=>"10"

（1）(++([[]][+[]])) + [+[]]  //运算符权重判断，安利一下第四题下面的文章
（2）(++([[]][0])) + [0]      // 16题中我们讲过+用来做类型转换Number([]) ===0
（3）+([] + 1) + [0]            //[[]]数组的第0项就是[],++代表自增+1
 *******  注意这一步不是 (++[]) + [0] 这样是错误的   **********
（4）+([] + 1) + [0]           // 前面+将"1"转成数字1 后边，+是拼接 "0" 所以是字符串"10"
*/

延伸  i++ 和 ++i 区别
/**
左值与右值的根本区别在于是否允许取地址 & 运算符获得对应的内存地址.

[左值]表示存储在计算机内存的对象，而不是常量或计算的结果。或者说左值是代表一个内存地址值，并且通过这个内存地址，就可以对内存进行读并且写（主要是能写）操作；这也就是为什么左值可以被赋值的原因了.

[右值]当一个符号或者常量放在操作符右边的时候，计算机就读取他们的 “右值”，也就是其代表的真实值。简单来说就是，左值相当于地址值，右值相当于数据值.

i++ //先赋值,后自增  [i++不能作为左值(左值是可以放到赋值符号左边的变量)]
a = i++; ==> a = i; i = i + 1;

++i //先自增,后赋值  [++i可以作为左值]
a = ++i; ==> i = i + 1; a = i;
*/
```

## 25:

```JavaScript
3.toString()
3..toString()
3...toString()
/**
error, "3", error
*/
```

## 26:

```JavaScript
(function(){
  var x = y = 1;
})();
console.log(y);
console.log(x);
/**
输出:
1
undefined
*/

//解析:
以上 ==>
(function(){
    y = 1;
    var x = y;
})();
console.log(y);
console.log(x);
==>
(function(){
    y = 1;
    var x;
    //console.log("第一个X="+x); // 第一个X= undefined
    x = y;
    //console.log("第二个X="+" "+x); // 第二个X= 1
})();
console.log(y);// y = 1
console.log(x);//x 局部变量 此处显示 undefined
```

## 27:

```JavaScript
var a = /123/,
b = /123/;
console.log(a == b,a === b);
/**
输出:
false false

解析:
正则是对象，引用类型，相等（==）和全等（===）都是比较引用地址
*/
```

## 28:

```JavaScript
var a = [1, 2, 3],
b = [1, 2, 3],
c = [1, 2, 4];
console.log(a == b,a == b,a > c,a < c);
/**
输出:
false false false true
解析:
相等（==）和全等（===）还是比较引用地址
引用类型间比较大小是按照字典序比较，就是先比第一项谁大，相同再去比第二项。
*/
```

## 29:

```JavaScript

```

## 31:

```JavaScript
function foo() { }
var oldName = foo.name;
foo.name = "bar";
[oldName, foo.name] 
/**
["foo", "foo"]

所有的函数都有一个name属性,该属性保存的是该函数名称的字符串.
函数的名字 不可变
*/
```

## ES的新特性:

```javascript
ES2016:

扩展运算符 ...
/**
将数组转换为用逗号分割的函数的参数列表
*/
function push(array, ...items) {
array.push(...items);
}
function add(x, y) {
return x + y;
}
var numbers = [4, 38];
add(...numbers) // 42


箭头函数:

function(){
    console.log("fuck");
}
==>
() => console.log("fuck");

includes()
/**用来判断一个数组是否包含一个指定的值，根据情况，如果包含则返回true，否则返回false*/

a ** b ==> Math.pow(a,b)

ES2017:

async 函数
/**
async函数返回一个 Promise 对象。
async函数内部return语句返回的值，会成为then方法回调函数的参数。
*/
async function f() {
  return 'hello world';
}
f().then(v => console.log(v))
// "hello world"

/**
async函数内部抛出错误，会导致返回的 Promise 对象变为reject状态。抛出的错误对象会被catch方法回调函数接收到
*/
async function f() {
  throw new Error('出错了');
}
f().then(
  v => console.log(v),
  e => console.log(e)
)
// Error: 出错了

/**
只有async函数内部的异步操作执行完，才会执行then方法指定的回调函数

解析:
函数getTitle内部有三个操作：抓取网页、取出文本、匹配页面标题。只有这三个操作全部完成，才会执行then方法里面的console.log
*/
async function getTitle(url) {
  let response = await fetch(url);
  let html = await response.text();
  return html.match(/<title>([\s\S]+)<\/title>/i)[1];
}
getTitle('http://www.baidu.com').then(console.log)
// "百度一下，你就知道"

/**
正常情况下，await命令后面是一个 Promise 对象。如果不是，会被转成一个立即resolve的 Promise 对象
*/
async function f() {
  return await 123;
}
f().then(v => console.log(v));
// 123

Object.keys()
/**返回一个数组，成员是参数对象自身的（不含继承的）所有可遍历（ enumerable ）属性的键名*/
栗子:
var obj = {foo:'zsx',baz:'sss'};
console.log(Object.keys(obj));// ["foo","baz"]

Object.values()
/**Object.values 方法返回一个给定对象自己的所有可枚举属性值的数组，值的顺序与使用for...in循环的顺序相同（区别在于for...in循环枚举原型链中的属性).*/
栗子:
var obj = { foo: 'bar', baz: 42 };
console.log(Object.values(obj)); // ['bar', 42]

Object.entries()
/** 返回一个数组，成员是参数对象自身的（不含继承的）所有可遍历（ enumerable ）属性的键值对数组 */
栗子:
var obj = { foo: 'bar', baz: 42 };  
Object.entries(obj);  // [["foo", "bar"], ["baz", 42] ]

大栗子:
let {keys, values, entries} = Object;  
let obj = {a: 1, b: 2, c: 3};  //若属性名是数值的话会按照数值大小，从小到大遍历.
for (let key of keys(obj)) {  
    console.log(key); // 'a', 'b', 'c'  
} 
for (let value of values(obj)) {  
    console.log(value); // 1, 2, 3  
}  
for (let [key, value] of entries(obj)) {  
console.log([key, value]); // ['a', 1], ['b', 2], ['c', 3]  
}

Object.getOwnPropertyDescriptors()
/** 该方法允许对一个属性的描述进行检索。在 Javascript 中， 属性 由一个字符串类型的 “名字”（name）和一个 “属性描述符”（property descriptor）对象构成 */
/** 返回一个对象的所有自身属性的描述符（.value,.writable,.get,.set,.configurable,enumerable） */
栗子:
let zsx = {
name:"zsx",
age:"18",
age2:"19",
age3:"20"
};
console.log(Object.getOwnPropertyDescriptors(zsx));

padStart()
/** 方法用另一个字符串填充当前字符串 (重复，如果需要的话)，以便产生的字符串达到给定的长度。填充从当前字符串的开始 (左侧) 应用的 */
栗子:
var zsx = "赵守鑫";
console.log(zsx3.padStart(7,"在前面"));
/** 在前面在赵守鑫 */

padEnd()
/** 与上个方法作用的位置相反 */
栗子:
var zsx = "赵守鑫";
console.log(zsx3.padEnd(7,"在后面"));
/** 赵守鑫在后面在 */

ShareArrayBuffer && Atomics //暂时跳过

ES2018:

rest 
/**将剩余对象的属性复制到一个新对象中*/
var {x, y, ...z} = {x: 1, y: 2, a: 3, b: 4};
console.log(z);	//{a: 3, b: 4}

spread 
/**将对象的属性快速复制到另一个对象*/
var {x, y, ...z} = {x: 1, y: 2, a: 3, b: 4};
var a = {x,y,...z};
console.log(a);//{x: 1, y: 2, a: 3, b: 4}

generator 函数:

栗子1:
function* countAppleSales () {// *用来表示生成器函数和普通函数的区别
    var saleList = [3, 7, 5];
    for (var i = 0; i < saleList.length; i++) {
        yield saleList[i];
    }
}
/* 构造迭代器 进行使用 */
var appleStore = countAppleSales(); // Generator { }
console.log(appleStore.next()); // { value: 3, done: false }
console.log(appleStore.next()); // { value: 7, done: false }
console.log(appleStore.next()); // { value: 5, done: false }
console.log(appleStore.next()); // { value: undefined, done: true }

栗子2:
/* yield* 迭代器(iterator)委托 */
function* stringIter() {
    var str = "bobsyouruncle";
    var idx = 0;
    while(idx < str.length)
        yield str[idx++];
}
function* strIter() {
    yield "jo";
    yield* stringIter();
}
var si2 = strIter();//最先运行 提升

console.log(si2.next().value);// jo
console.log(si2.next().value);// b 此时已委托到stringIter生成器 
console.log(si2.next().value);// o
console.log(si2.next().value);// b
```

## JavaScript奇技淫巧

```JavaScript
/**
其他
*/
var obj3 = { 
  foo: { bar: [11, 22, 33, 44], baz: { bing: true, boom: 'Hello' } } 
};
// 第三个参数为格式化需要的空格数目
JSON.stringify(obj3,null,4); 

/**
清空和截短数组
*/
const arr = [11, 22, 33, 44, 55, 66];

// 截取
arr.length = 3;
console.log(arr); //=> [11, 22, 33];

// 清空
arr.length = 0;
console.log(arr); //=> []
console.log(arr[2]); //=> undefined

/**
switch 语句中使用 范围
*/
function getWaterState(tempInCelsius) {
  let state;
  
  switch (true) {
    case (tempInCelsius <= 0): 
      state = 'Solid';
      break;
    case (tempInCelsius > 0 && tempInCelsius < 100): 
      state = 'Liquid';
      break;
    default: 
      state = 'Gas';
  }
  return state;
}

```


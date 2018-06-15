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

## var val = 'smtg'; console.log('Value is ' + (val === 'smtg') ? 'Something' : 'Nothing'); 

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
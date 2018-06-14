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
```


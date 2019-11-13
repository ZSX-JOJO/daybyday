## ECMAScript && 其他 瞎记



- `btoa()`：任意值转为 Base64 编码  【适合ASCII 码】
- `atob()`：Base64 编码转为原来的值 【适合ASCII 码】

```javascript
function b64Encode(str) {
  return btoa(encodeURIComponent(str));
}

function b64Decode(str) {
  return decodeURIComponent(atob(str));
}

b64Encode('你好') // "JUU0JUJEJUEwJUU1JUE1JUJE"
b64Decode('JUU0JUJEJUEwJUU1JUE1JUJE') // "你好"
```

###### Web 通信 之 长连接、长轮询（long polling）



###### Blob对象

###### call()   接受参数列表

```javascript
fun.call(thisArg, arg1, arg2, ...)
```

###### apply() 接受参数数组

```javascript
func.apply(thisArg, [argsArray])
```

###### bind()

```javascript
function.bind(thisArg[, arg1[, arg2[, ...]]])
```
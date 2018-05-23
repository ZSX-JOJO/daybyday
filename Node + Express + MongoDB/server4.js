/**
 * 中间件
*/
var express = require('express');

var app = express();

app.use(function(req,res,next){
    console.log("first middleware");
    next();//若此处不写,则不会传递给下一个中间件,则o**k不会输出,浏览器一直处于加载中.
});

app.use(function(req,res,next){
    console.log("second middleware");
    next();//与上同理;若不想传递给下一个中间件,可以使用res.sennd()结束,从而不会传递给下一个中间件
});

app.get('/',function(req,res,next){
    //此function为中间件的函数,此处 处理完就结束了并没有传递给下一个中间件;next并没有进行一个处理.
    console.log("o**k");
    res.send("o**k");
});

app.listen(3000);
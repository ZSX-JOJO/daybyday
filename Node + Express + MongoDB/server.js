var express = require('express');
var bodyParser = require('body-parser');//第三方类库 处理post请求 express常用中间件
var fs = require('fs');

var app = express();//前者是 后者这个对象的一个实例
var multer  = require('multer');//处理文件上传
var upload = multer({ dest: 'uploads/' });

/**
 *  1. bodyParser.json(options): 解析json数据
    2. bodyParser.raw(options): 解析二进制格式(Buffer流数据)
    3. bodyParser.text(options): 解析文本数据
    4. bodyParser.urlencoded(options): 解析UTF-8的编码的数据。
*/

// create application/json parser
var jsonParser = bodyParser.json();
 
// create application/x-www-form-urlencoded parser
var urlencodedParser = bodyParser.urlencoded({ extended: false });
app.get('/fuck/:id/user/:name',function(req,res){//   /fuck/:id  id可随便改 如 a b c params.id要与之对应 有':'代表动态的 /fuck/:id/user/:name 例如/fuck/30000
    //路由的参数 是动态的
    //路由的参数 是正则表达式
    // res.send('this is the homepage');
    // var responseObject = req.method;
    console.dir(req.params);
    var responseObject = [{name:'123'},{age:'28'},{sex:'man'},{dream:'Become wind'}];
    // res.send(responseObject);
    // var responseBoject = {
    //     name:'zsx',
    //     age:'28',
    //     sex:'man'
    // };
    //不需要 JSON.parse()进行处理
    // res.send(responseObject + req.params.id);
    res.send(responseObject);
});

app.get('/',function(req,res){
    console.dir(req.query);
    res.send('home page' + req.query.find);
});

//上传文件  表单

app.get('/form',function(req,res){
    var form = fs.readFileSync('./form.html',{encoding:"utf8"});
    res.send(form);
});

app.post('/',jsonParser,function(req,res){//此处搭配postman进行测试  处理json时
    console.dir(req.body);
    res.send('post ok:' + req.body.name);
});

app.post('/upload2',urlencodedParser,function(req,res){//此处搭配postman进行测试  处理UTF-8的编码的数据
    console.dir(req.body);
    res.send('post ok:' + req.body.name);
});

app.post('/upload',upload.single('logo'),function(req,res){//此处进行上传到指定文件夹
    res.send({"ret_code":0});
});

app.listen(3000);
console.log('listening to port 3000');
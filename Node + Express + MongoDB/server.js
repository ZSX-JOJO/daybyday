var express = require('express');

var app = express();

app.get('/',function(req,res){
    // res.send('this is the homepage');
    // var responseObject = req.method;
    var responseObject = [{name:'123'},{age:'28'},{sex:'man'},{dream:'Become wind'}];
    // res.send(responseObject);
    // var responseBoject = {
    //     name:'zsx',
    //     age:'28',
    //     sex:'man'
    // };
    //不需要 JSON.parse()进行处理
    res.send(responseObject);
});

app.listen(3000);
console.log('listening to port 3000');
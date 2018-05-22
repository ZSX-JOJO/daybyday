/**
 * express + multer 实现多图上传
*/

var fs = require('fs');
var express = require('express');
var multer = require('multer');

 var app = express();
//  var upload = multer({dest:'upload3'});

var createFolder = function(folder){
    try{
        fs.accessSync(folder);
    }catch(e){
        fs.mkdirSync(folder);
    }
};

var uploadFolder = './upload3';

createFolder(uploadFolder);

// 通过 filename 属性定制
var storage = multer.diskStorage({
    destination: function (req, file, cb) {
        cb(null, uploadFolder);    // 保存的路径，备注：需要自己创建
    },
    filename: function (req, file, cb) {
        // 将保存文件名设置为 字段名 + 时间戳，比如 logo-1478521468943
        cb(null, file.fieldname + '-' + Date.now());  
    }
});

// 通过 storage 选项来对 上传行为 进行定制化
var upload = multer({ storage: storage })

 //多图上传
 app.post('/upload',upload.array('logo',2),function(req,res,next){
    var file = req.file;
     res.send({ret_code:'0'});
 });

 app.get('/form3',function(req,res,next){
     var form = fs.readFileSync('./form3.html',{encoding:'utf-8'});
     res.send(form);
 });

 app.listen(3000);

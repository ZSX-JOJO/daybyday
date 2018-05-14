/**
 * 流和管道
*/
var fs = require('fs');

/**
 * <Buffer> 将readMe.txt中的内容存储为一个或者多个<Buffer>
*/

//此时读取出的内容为<Buffer> ; 若需要显示实际内容 需要添加参数  例如 UTF-8
var myReadStream =  fs.createReadStream(__dirname + '/readMe.txt','UTF-8');

var myWriteStream = fs.createWriteStream(__dirname + '/writeMe.txt','UTF-8');
/**
 * 管道
*/
// myReadStream.pipe(myWriteStream);

//或者 不添加 UTF-8参数 使用如下方法设置
// myReadStream.setEncoding('utf-8');
var data = '';
/**
 * __dirname 变量获取当前模块文件所在目录的完整绝对路径
*/
myReadStream.on('data',function(chunk){
    // data += chunk;
    myWriteStream.write(chunk);
    // console.log('new chunk received');
    // console.log(chunk);
    // console.log(__dirname);
});

myReadStream.on('end',function(){
    // console.log(data);
});
// fs.createReadStream('readMe.txt',{start:0,end:3});

/**
 * 其他
*/
var myWriteStream2 = fs.createWriteStream(__dirname + '/writeMe2.txt','UTF-8');
var writeData = 'fuck you!';
myWriteStream2.write(writeData);
myWriteStream2.end();
myWriteStream2.on('finish',function(){
    console.log('finished');
});
'use strict';

var fs = require('fs');
/**
 *同步（Synchronous）和异步（Asynchronous）
 *异步读取时，传入的回调函数接收两个参数
 */
fs.readFile('sample.txt', 'utf-8', function (err, data) {
    if (err) {
        console.log('readFile'+ err);
    } else {
        console.log(data+"异步读取readFile方法读取的sample.txt中的内容");
    }
});
/**
 * 同步读取的函数和异步函数相比，多了一个Sync后缀，并且不接收回调函数，函数直接返回结果
 * 如果同步读取文件发生错误，则需要用try...catch捕获该错误：
 * try {
    var data = fs.readFileSync('sample.txt', 'utf-8');
    console.log(data);
	} catch (err) {
	    // 出错了
	}
 */
var data = fs.readFileSync('sample.txt', 'utf-8');
console.log(data+"同步读取readFileSync方法读取sample.txt中的内容");
/**
 *将数据写入文件是通过fs.writeFile()实现的：
 */
var data = "改写02fs.js中的原来的18353627528";
fs.writeFile('change.txt',data,function(err){
	if(err){
		console.log('writeFile'+ err);
	}else{
		console.log('writeFile方法写入成功o**k');
	}
});
/**
 *获取文件大小，创建时间等信息，可以使用fs.stat()，它返回一个Stat对象，能告诉我们文件或目录的详细信息
 */
fs.stat('sample.txt', function (err, stat) {
    if (err) {
        console.log(err);
    } else {
        // 是否是文件:
        console.log('isFile: ' + stat.isFile());
        // 是否是目录:
        console.log('isDirectory: ' + stat.isDirectory());
        if (stat.isFile()) {
            // 文件大小:
            console.log('size: ' + stat.size);
            // 创建时间, Date对象:
            console.log('birth time: ' + stat.birthtime);
            // 修改时间, Date对象:
            console.log('modified time: ' + stat.mtime);
        }
    }
});
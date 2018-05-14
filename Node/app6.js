/*
基础篇
读写文件  同步异步
*/

var fs = require('fs');


//readFileSync(文件名路径,编码)
/*
nodejs在执行JavaScript时是单线程的(nodejs并不是单线程的),
*/
//Sync同步执行  终端内显示 'fs读写文件'  'finished'
// var readMe = fs.readFileSync('app2-read.txt','utf-8');
//防止阻塞 nodejs使用异步 终端内显示 'finished' 'fs读写文件'
var readMe = fs.readFile('app2-read.txt','utf-8',function(err,data){
    // console.log(data);
    fs.writeFile('app2-write.txt',data,function(){
        console.log('write has finished');
    });
});
// console.log(readMe);
console.log('finished');
//将读取的app2-read.txt中的内容 放入到新创建的 app2-write.txt中
// fs.writeFileSync('app2-write.txt',readMe);
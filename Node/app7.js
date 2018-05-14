/**
 * 创建和删除目录
*/
var fs = require('fs');

//异步删除
// fs.unlink('app2-write.txt',function(){
//     console.log('delete file');
// });

//同步删除
// fs.unlinkSync('app2-write.txt');

//删除文件目录
// fs.rmdir('test',function(err,data){
//     console.log('delete dir ojbk');
// });

//创建文件目录
// fs.mkdir('test',function(err,data){
//     console.log('mk dir ojbk');
// });

//综合
fs.mkdir('stuff',function(){
    fs.readFile('readMe.txt','utf-8',function(err,data){
        fs.writeFile('./stuff/writeMe.txt',data,function(){
            console.log('copy is ojbk');
        });
    });
});
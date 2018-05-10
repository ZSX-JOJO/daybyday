'use strict';

var fs = require('fs');

// 打开一个流:
/**
 *流也是一个对象，我们只需要响应流的事件就可以了：
 *data事件表示流的数据已经可以读取了，
 *end事件表示这个流已经到末尾了，没有数据可以读取了，
 *error事件表示出错了
 */
var rs = fs.createReadStream('sample.txt', 'utf-8');

rs.on('data', function (chunk) {
    console.log('DATA:')
    console.log(chunk);
});

rs.on('end', function () {
    console.log('END');
});

rs.on('error', function (err) {
    console.log('ERROR: ' + err);
});

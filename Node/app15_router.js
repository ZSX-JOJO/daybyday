var fs = require('fs');

//route 	路线, 路径, 路, 线路, 线, 通路, 行程, 途, 旅程 发送, 击溃
function route(handle, pathname, response,params) {
    console.log('Routing a request for ' + pathname);
    if (typeof handle[pathname] === 'function') {
        handle[pathname](response,params);
    } else {
        response.writeHead(200, { 'Content-Type': 'text/html' });
        fs.createReadStream(__dirname + '/404.html', 'utf8').pipe(response);
    }
}

module.exports.route = route;
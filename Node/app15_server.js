var http = require('http');
var fs = require('fs');
var url = require('url');

function startServer(route, handle) {
    var onRequest = function(request, response) {
        var pathname = url.parse(request.url).pathname;
        console.log('Request received ' + pathname);
        //true 若为false 则输出字符串
        var params = url.parse(request.url,true).query;
        route(handle, pathname, response,params);
    };

    var server = http.createServer(onRequest);

    server.listen(3000, '127.0.0.1');
    console.log('Server started on localhost port 3000');
}

module.exports.startServer = startServer;
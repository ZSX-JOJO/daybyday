var http = require('http');
var fs = require('fs');
var url = require('url');
var querystring = require('querystring');

function startServer(route, handle) {
    var onRequest = function(request, response) {
        var pathname = url.parse(request.url).pathname;
        console.log('Request received ' + pathname);
        // var data = '';
        var data = [];
        request.on('error',function(err){
            console.error(err);
        }).on('data',function(chunk){
            data.push(chunk);
            // data += chunk;
        }).on('end',function(){
            if (request.method === "POST") {
                if (data.length > 1e6) {
                    request.connection.destroy();
                }
                data = Buffer.concat(data).toString();
                route(handle, pathname, response, querystring.parse(data));
            } else {
                //只有get方法  才可以取到值  pos方法取不到值
                var params = url.parse(request.url, true).query;
                route(handle, pathname, response, params);
                // if(request.method === 'POST'){
                //     route(handle, pathname, response,querystring.parse(data));
                // }else{
                //     //true 返回对象 若为false 则输出字符串
                //     var params = url.parse(request.url,true).query;
                //     //params 传递给 router
                //     route(handle, pathname, response,params);
                // }
            }
        });
    };

    var server = http.createServer(onRequest);

    server.listen(3000, '127.0.0.1');
    console.log('Server started on localhost port 3000');
}
module.exports.startServer = startServer;
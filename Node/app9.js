/**
 * web服务器
*/
var http = require('http');

var onRequest = function(request,response){
    console.log('Request received');
    response.writeHead(200, { 'Content-Type': 'text/plain' });
    // response.write('Hello from out application');
    response.end('Hello from out application');
};

var server = http.createServer(onRequest);

server.listen(3000, '127.0.0.1');
console.log('Server started on localhost port 3000');
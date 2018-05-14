/**
 * web服务器
*/
var http = require('http');

var onRequest = function(request,response){
    console.log('Request received');
    response.writeHead(200, { 'Content-Type': 'application/json' });
    // response.write('Hello from out application');
    var myObj = {
        name: "hfpp2012",
        job: "programmer",
        age: 27
    };
    response.end(JSON.stringify(myObj));//JSON.parse(JSON.stringify(myObj))
};

var server = http.createServer(onRequest);

server.listen(3000, '127.0.0.1');
console.log('Server started on localhost port 3000');
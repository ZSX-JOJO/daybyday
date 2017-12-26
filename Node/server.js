var http = require('http');
http.createServer(function(request,response){
	response.writeHead(200,{'Contetnt-Type':'text/plan'});
	response.end('hello 23333');
}).listen(8888);
console.log('Server running at http://127.0.0.1:8888/');
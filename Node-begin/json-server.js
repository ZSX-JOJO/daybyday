var http = require('http');
function json(req,res){
	console.log("INCOMING REQUEST:" +req.method+""+req.url);
	res.writeHead(200,{"Content-Type":"application/json"});
	res.end(JSON.stringify({err:null})+"\n");
}
var s = http.createServer(json);
s.listen(8080);
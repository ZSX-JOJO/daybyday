var http = require("http");
function process_request(req,res){
  var body = "web·şÎñÆ÷?????";
  var content_length = body.length;
  res.writeHead(200,{
    'Content-Length':content_length,
    'Content-Type':'text/plain',
  });
  res.end(body);
}
var s = http.createServer(process_request);
s.listen(8080);
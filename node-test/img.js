var http = require('http'),
	fs = require('fs');


function img_list(callback){
	fs.readdir(
		"albums",
		function(err,files){
			if(err){
				callback(err);
				return;
			}
			callback(null,files);
		}
	);
}

function img_list_request(req,res){
	console.log("INCOMING REQUEST:" + req.method+ "" +req.url);
	img_list(function(err,albums){
		if(err){
			res.writeHead(503,{"Content-Type":"application/json"});
			res.end(JSON.stringify(err) + "\n");
			return;
		}

		var out = { error:null,
					data:{albums:albums}
		};
		res.writeHead(200,{"Content-Type":"application/json"});
		res.end(JSON.stringify(out) + "\n");
	});
}

var s = http.createServer(img_list_request);
s.listen(8080);
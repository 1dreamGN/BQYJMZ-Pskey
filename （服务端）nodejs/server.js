var http = require('http');
var util = require('util');
var url = require('url');
var port = 18080;
http.createServer(function(req, res) {
	res.writeHead(200, {'Content-Type': 'text/html'});
	var urlp = url.parse(req.url, true);
	if(urlp.query.act == 'getp'){
		var uin = urlp.query.uin;
		var pwd = urlp.query.pwd;
		var vcode = urlp.query.vcode;
		var ver = urlp.query.ver;
		if(uin == ''){
			res.write('uin null');
		}else if(pwd == ''){
			res.write('pwd null');
		}else if(vcode == ''){
			res.write('vcode null');
		}else{
			if(ver == '2.0'){
				var p2 = require("./p2.js");
				res.write(p2.getp(pwd,uin,vcode));
			}else if(ver != '2.0'){
				var p = require("./p.js");
				res.write(p.getp(uin,pwd,vcode));
			}
		}
	}else{
		res.write(req.url+'<br>');
		res.write(util.inspect(url.parse(req.url, true))+'<br>');
	}
    res.end();
}).listen(port);
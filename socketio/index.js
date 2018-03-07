var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var pseudos = [];

server.listen(3000);

app.get('/', function (req, res) {
	res.sendfile(__dirname + '/index.html');
});

io.on('connection', function (socket) {

	socket.on('nouveau_joueur',function(pseudo){
		pseudos.push(pseudo)
		io.emit('savePseudo',pseudos)
	});

	socket.on('commencer',function(){
		io.emit('demarrer');
	});
});
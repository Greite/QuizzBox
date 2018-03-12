var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var pseudos = [];
var quizz_nom = "";
var all_client = [];

server.listen(3000);

io.on('connection', function (socket) {
	var pseudo = "";
	io.emit('saveQuizz',quizz_nom)
	io.emit('savePseudo',pseudos)

	socket.on('nouveau_joueur',function(p){
		pseudo = p
		pseudos.push(pseudo)
		io.emit('savePseudo',pseudos)
		console.log(pseudos)
	});

	socket.on('commencer',function(){
		io.emit('demarrer');
	});

	socket.on('nomQuizz',function(nom){
		quizz_nom = nom
		io.emit('saveQuizz',nom)
	});

	socket.on('disconnect', function(reason){
		var i = pseudos.indexOf(pseudo);
		pseudos.splice(i, 1);
		io.emit('savePseudo',pseudos)
		console.log(pseudos)
	});
});
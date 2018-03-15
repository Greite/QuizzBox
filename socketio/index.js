var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var pseudos = [];
var reponses = 0;
var quizz_nom = "";
var quizz_id = "";

server.listen(3000);

io.on('connection', function (socket) {

	var pseudo = "";
	io.emit('saveQuizz',quizz_nom)
	io.emit('savePseudo',pseudos)

	//accueil
	socket.on('nouveau_joueur',function(p){
		pseudo = p
		pseudos.push(pseudo)
		io.emit('savePseudo',pseudos)
		console.log(pseudos)
	});

	socket.on('commencer',function(id){
		quizz_id = id;
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

	//question
	socket.on('recupId',function(){
		io.emit('saveId',{ quizz_id , pseudos, pseudo })
	});

	socket.on('suivant',function(){
		reponses = 0
		io.emit('questionSuivant')
	});

	socket.on('nombreReponse',function(){
		reponses = reponses + 1;
		io.emit('nbReponses',reponses)
	});
});
var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var fs = require('fs');
var dir = [];
var pseudos = [];
var tabScore = [];
var reponses = 0;
var quizz_nom = "";
var quizz_id = "";
var nomQuizz = "";
var partie_on = false;

server.listen(3000);

io.on('connection', function (socket) {
	if (partie_on) {
		io.emit('partieOn')
	}else {
		var pseudo = "";
		var tabjson;
		io.emit('saveQuizz',quizz_nom)
		io.emit('savePseudo',pseudos)

		//InterfaceAdmin
		socket.on('createFileThemes',function(data){
			var json = JSON.stringify(data);
			fs.writeFile('themes.json', json, function (err) {
				if (err) throw err;
				console.log('Saved!');
			});
		});

		socket.on('createFileQuizz',function(data){
			var write = false;
			nomQuizz = data[1].split(' ').join('_');
			var json = JSON.stringify(data[0]);

			fs.readdir('quizz/', function(err, items) {
				items.forEach(function(e){
					if (nomQuizz+".json" === e) {
						write = true
					}
				})
			});

			if (!write) {
				fs.writeFile('quizz/'+nomQuizz+'.json', json, function (err) {
					if (err) throw err;
					console.log('Write ! '+nomQuizz);
				});
			}else{
				fs.appendFile('quizz/'+nomQuizz+'.json', json, function (err) {
					if (err) throw err;
					console.log('Append ! '+nomQuizz);
				});
			}
		});

		//accueil
		socket.on('nouveau_joueur',function(p){
			pseudo = p
			pseudos.push(pseudo)
			io.emit('savePseudo',pseudos)
			console.log(pseudos)

			fs.readFile('themes.json', 'utf8', function (err, data) {
				if (err) throw err;
				io.emit('readThemes',data)
			});
		});

		socket.on('commencer',function(id){
			quizz_id = id;
			io.emit('demarrer');
			partie_on=true;
		});

		socket.on('nomQuizz',function(nom){
			quizz_nom = nom
			io.emit('saveQuizz',nom)
		});

		socket.on('finPartie',function(){
			console.log('Reseting Server ! Game Over !');
			io.emit('redirectScore');
		});

		socket.on('saveScore',function(data){
			tabScore.push(data);
			console.log(tabScore)
		})

		socket.on('disconnect', function(reason){
			var i = pseudos.indexOf(pseudo);
			pseudos.splice(i, 1);
			io.emit('savePseudo',pseudos)
			console.log(pseudos)
			if (pseudos.length == 0) {
				console.log('Reseting Server ! All clients left !');
				dir = [];
				pseudos = [];
				tabScore = [];
				reponses = 0;
				quizz_nom = "";
				quizz_id = "";
				nomQuizz = "";
				partie_on = false;

			}
		});

		//question
		socket.on('loadQuizz',function(data){
			nomQuizz = data.split(' ').join('_');
			fs.readFile('quizz/'+nomQuizz+'.json', 'utf8', function (err, data) {
				if (err) throw err;
				io.emit('saveId',{data, quizz_id , pseudos, pseudo })
			});
		});

		socket.on('suivant',function(){
			reponses = 0
			io.emit('questionSuivant')
		});

		socket.on('nombreReponse',function(){
			reponses = reponses + 1;
			io.emit('nbReponses',reponses)
		});

		//Affichage scores
		socket.on('loadQuizzId',function(){
			io.emit('saveQuizzId',{quizz_id,quizz_nom,tabScore})
			socket.disconnect();
		})
	}
});

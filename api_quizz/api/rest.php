<?php
require '../src/vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

$settings = require_once '../src/conf/api_settings.php';
$errors = require_once '../src/conf/api_errors.php';
$dependencies = require_once '../src/conf/api_deps.php';

$config = parse_ini_file("../src/conf/quizz.db.conf.ini");

$db = new Illuminate\Database\Capsule\Manager();

$db->addConnection($config);
$db->setAsGlobal();
$db->bootEloquent();

$configuration = array_merge($settings, $errors, $dependencies);
$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);

$app->add(function($request, $response, callable $next){
    $response = $next($request, $response);
    $response = $response->withHeader('Content-type', 'application/json; charset=utf-8');
    $response = $response->withHeader("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept,Authorization");
    $response = $response->withHeader('Access-Control-Allow-Origin', $request->getHeader('Origin'));
    $response = $response->withHeader('Access-Control-Allow-Methods', 'OPTIONS, GET, POST, PUT, PATCH, DELETE');
    $response = $response->withHeader('Access-Control-Allow-Credentials', 'true');
    return $response;
});

$app->options('/{routes:.+}', function ($request, $response, $args){
    return $response;
});

$app->post('/users[/]','\quizz\control\QuizzController:addUser');

$app->post('/users/signin[/]','\quizz\control\QuizzController:login');

$app->get('/users/{id}[/]','\quizz\control\QuizzController:user');

$app->get('/users[/]','\quizz\control\QuizzController:getUsers');

$app->get('/themes[/]','\quizz\control\QuizzController:getThemesWithQuizz');

$app->get('/quizz[/]','\quizz\control\QuizzController:getQuizz');

$app->get('/quizz/{id}[/]','\quizz\control\QuizzController:getQuizzId');

$app->get('/quizz/{id}/commentaires[/]','\quizz\control\QuizzController:getQuizzComms');

$app->post('/quizz/{id}/commentaires[/]','\quizz\control\QuizzController:addCommentaire');

$app->put('/quizz/{id}/commentaires/{id_comm}[/]','\quizz\control\QuizzController:putCommentaire');

$app->delete('/quizz/{id}/commentaires/{id_comm}[/]','\quizz\control\QuizzController:deleteCommentaire');

$app->post('/quizz[/]','\quizz\control\QuizzController:addQuizz');

$app->post('/question[/]','\quizz\control\QuizzController:addQuestion');

$app->post('/reponses[/]','\quizz\control\QuizzController:addReponses');

$app->get('/questions/{id}/reponses[/]','\quizz\control\QuizzController:getQuestionId');

$app->get('/scores/{id}[/]','\quizz\control\QuizzController:getScoresId');

$app->post('/scores[/]','\quizz\control\QuizzController:addScore');

$app->get('/quizz/{id}/notes[/]','\quizz\control\QuizzController:getQuizzNotes');

$app->post('/quizz/{id}/notes[/]','\quizz\control\QuizzController:addNote');

$app->put('/quizz/{id}/notes/{id_note}[/]','\quizz\control\QuizzController:putNote');

$app->run();

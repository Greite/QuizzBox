<?php

namespace quizz\control;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use quizz\model\Theme;
use quizz\model\Question;
use quizz\model\Quizz;
use quizz\model\Reponse;
use quizz\model\User;

use Ramsey\Uuid\Uuid;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException ;
use Firebase\JWT\BeforeValidException;

class QuizzController {

    public function addUser(Request $req, Response $resp, $args){
        $parsedBody = $req->getParsedBody();

        $user = new User;
        $uuid4 = Uuid::uuid4();
        $user->id = $uuid4;
        $user->login = filter_var($parsedBody['login'], FILTER_SANITIZE_SPECIAL_CHARS);
        $user->password = password_hash($parsedBody['password'], PASSWORD_DEFAULT);
        $user->mail = filter_var($parsedBody['mail'], FILTER_SANITIZE_SPECIAL_CHARS);
        $user->save();
        $resp = $resp->withStatus(201);
        $resp = $resp->withHeader('Location', "/user/".$user->id);
        $resp = $resp->withHeader('Access-Control-Allow-Origin', $req->getHeader('Origin')[0]);
        $resp = $resp->withJson(array('user' => array('id' => $user->id, 'login' => $user->login, 'mail' => $user->mail)));
        return $resp;

    }

    public function user(Request $req, Response $resp, $args){
        try {
            $secret = "quizzbox";
            $h = $req->getHeader('Authorization')[0];
            $tokenstring = sscanf($h, "Bearer %s")[0];
            $token = JWT::decode($tokenstring, $secret, ['HS512']);
            try{
                User::findOrFail($token->id);
            }catch(ModelNotFoundException $e){
                $resp = $resp->withStatus(401);
                $resp = $resp->withJson(array('type' => 'error', 'error' => 401, 'message' => "Le token ne correspond pas"));
                return $resp;
            }
            try{
                $user = User::findorFail($args['id']);
            } catch (ModelNotFoundException $e) {
                $resp = $resp->withStatus(404);
                $resp = $resp->withJson(array('type' => 'error', 'error' => 404, 'message' => 'Ressource non disponible : /user/'.$args['id']));
                return $resp;
            }
            $resp = $resp->withJson(array('id' => $user->id, 'login' => $user->login, 'mail' => $user->mail));
            return $resp;
        }catch(ExpiredException $e) {
            $resp = $resp->withStatus(401);
            $resp = $resp->withJson(array('type' => 'error', 'error' => 401, 'message' => "L'authentification a expirée"));
            return $resp;
        }catch(SignatureInvalidException $e) {
            $resp = $resp->withStatus(401);
            $resp = $resp->withJson(array('type' => 'error', 'error' => 401, 'message' => "Mauvaise signature"));
            return $resp;
        }catch(BeforeValidException $e) {
            $resp = $resp->withStatus(401);
            $resp = $resp->withJson(array('type' => 'error', 'error' => 401, 'message' => "Les informations ne correspondent pas"));
            return $resp;
        }catch(\UnexpectedValueException $e) {
            $resp = $resp->withStatus(401);
            $resp = $resp->withJson(array('type' => 'error', 'error' => 401, 'message' => "Les informations ne correspondent pas"));
            return $resp;
        }
    }

    public function login(Request $req, Response $resp, $args){
        $parsedBody = $req->getParsedBody();
        if (!is_null($parsedBody['login']) && !is_null($parsedBody['password'])) {
            try {
                $user = User::where('login', '=', $parsedBody['login'])->firstOrFail();
            } catch (ModelNotFoundException $e) {
                $resp = $resp->withStatus(404);
                $resp = $resp->withJson(array('type' => 'error', 'error' => 404, 'message' => 'Utilisateur ou mot de passe incorrect'));
                return $resp;
            }
            if (password_verify($parsedBody['password'], $user->password)) {
                $secret = "quizzbox";

                $token = JWT::encode(['iss' => 'http://api.quizzbox.local:10080/users/signin',
                    'aud' => 'http://api.quizzbox.local:10080/',
                    'iat' => time(),
                    'exp' => time() + 43200,
                    'id' => (string)$user->id,
                    'mail' => (string)$user->mail],
                    $secret, 'HS512');
                $resp = $resp->withStatus(200);
                $resp = $resp->withJson(array('login' => $user->login, 'mail' => $user->mail, 'id' => $user->id, 'token' => $token));
                return $resp;
            } else {
                $resp = $resp->withStatus(404);
                $resp = $resp->withJson(array('type' => 'error', 'error' => 404, 'message' => 'Utilisateur ou mot de passe incorrect'));
                return $resp;
            }
        }
    }

    public function getThemesWithQuizz(Request $req, Response $resp, $args){
        try {
            $themes = Theme::with('quizz')->get();
        } catch (ModelNotFoundException $e) {
            $resp = $resp->withStatus(404);
            $resp = $resp->withJson(array('type' => 'error', 'error' => 404, 'message' => 'Ressource non disponible : /themes/'.$args['id']));
            return $resp;
        }
        $tabtheme=[
            "type"=>"ressource",
            "meta"=>[$date=date('d/m/y')],
            "themes"=>$themes,
        ];
        $resp = $resp->withStatus(200);
        $resp = $resp->withJson($tabtheme);
        return $resp;
    }

    public function getQuizz(Request $req, Response $resp, $args){
        try {
            $quizz = Quizz::all();
        } catch (ModelNotFoundException $e) {
            $resp = $resp->withStatus(404);
            $resp = $resp->withJson(array('type' => 'error', 'error' => 404, 'message' => 'Ressource non disponible : /quizz/'));
            return $resp;
        }
        $tabquizz=[
            "type"=>"collection",
            "meta"=>[$date=date('d/m/y')],
            "quizz"=>$quizz,
        ];
        $resp = $resp->withStatus(200);
        $resp = $resp->withJson($tabquizz);
        return $resp;
    }

    public function getQuizzId(Request $req, Response $resp, $args){
        try {
            $quizz = Quizz::where('id','=',$args['id'])->with('questions')->get();
        } catch (ModelNotFoundException $e) {
            $resp = $resp->withStatus(404);
            $resp = $resp->withJson(array('type' => 'error', 'error' => 404, 'message' => 'Ressource non disponible : /quizz/'.$args['id']));
            return $resp;
        }
        $tabquizz=[
            "type"=>"ressource",
            "meta"=>[$date=date('d/m/y')],
            "quizz"=>$quizz,
        ];
        $resp = $resp->withStatus(200);
        $resp = $resp->withJson($tabquizz);
        return $resp;
    }

    public function getQuestionId(Request $req, Response $resp, $args){
        try {
            $quest = Question::where('id_quizz','=',$args['id'])->with('reponses')->get();
        } catch (ModelNotFoundException $e) {
            $resp = $resp->withStatus(404);
            $resp = $resp->withJson(array('type' => 'error', 'error' => 404, 'message' => 'Ressource non disponible : /questions/'.$args['id']));
            return $resp;
        }
        $tabquest=[
            "type"=>"ressource",
            "meta"=>[$date=date('d/m/y')],
            "quizz"=>$quest,
        ];
        $resp = $resp->withStatus(200);
        $resp = $resp->withJson($tabquest);
        return $resp;
    }

    public function addQuizz(Request $req, Response $resp, $args){
        try {
            $secret = "quizzbox";
            $h = $req->getHeader('Authorization')[0];
            $tokenstring = sscanf($h, "Bearer %s")[0];
            $token = JWT::decode($tokenstring, $secret, ['HS512']);
            try{
                User::findOrFail($token->id);
            }catch(ModelNotFoundException $e){
                $resp = $resp->withStatus(401);
                $resp = $resp->withJson(array('type' => 'error', 'error' => 401, 'message' => "Le token ne correspond pas"));
                return $resp;
            }
            $parsedBody = $req->getParsedBody();
            $quizz = new Quizz;
            $uuid4 = Uuid::uuid4();
            $quizz->id = $uuid4;
            $quizz->nom = filter_var($parsedBody['nom'], FILTER_SANITIZE_SPECIAL_CHARS);
            $quizz->id_createur = filter_var($parsedBody['id_createur'], FILTER_SANITIZE_SPECIAL_CHARS);
            $quizz->save();
            $quizz->themes()->attach($parsedBody['id_theme']);
            $resp = $resp->withStatus(201);
            $resp = $resp->withJson(array('quizz' => array('id' => $quizz->id, 'nom' => $quizz->nom, 'id_createur' => $quizz->id_createur, 'themes' => $quizz->themes)));
            return $resp;
        }catch(ExpiredException $e) {
            $resp = $resp->withStatus(401);
            $resp = $resp->withJson(array('type' => 'error', 'error' => 401, 'message' => "La carte a expirée"));
            return $resp;
        }catch(SignatureInvalidException $e) {
            $resp = $resp->withStatus(401);
            $resp = $resp->withJson(array('type' => 'error', 'error' => 401, 'message' => "Mauvaise signature"));
            return $resp;
        }catch(BeforeValidException $e) {
            $resp = $resp->withStatus(401);
            $resp = $resp->withJson(array('type' => 'error', 'error' => 401, 'message' => "Les informations ne correspondent pas"));
            return $resp;
        }catch(\UnexpectedValueException $e) {
            $resp = $resp->withStatus(401);
            $resp = $resp->withJson(array('type' => 'error', 'error' => 401, 'message' => "Les informations ne correspondent pas"));
            return $resp;
        }
    }

     public function addQuestion(Request $req, Response $resp, $args){
        try {
            $secret = "quizzbox";
            $h = $req->getHeader('Authorization')[0];
            $tokenstring = sscanf($h, "Bearer %s")[0];
            $token = JWT::decode($tokenstring, $secret, ['HS512']);
            try{
                User::findOrFail($token->id);
            }catch(ModelNotFoundException $e){
                $resp = $resp->withStatus(401);
                $resp = $resp->withJson(array('type' => 'error', 'error' => 401, 'message' => "Le token ne correspond pas"));
                return $resp;
            }
            $parsedBody = $req->getParsedBody();
            $question = new Question;
            $question->texte = filter_var($parsedBody['intitule'], FILTER_SANITIZE_SPECIAL_CHARS);
            $question->id_quizz = filter_var($parsedBody['id_quizz'], FILTER_SANITIZE_SPECIAL_CHARS);
            $id_question = $question->save();
            
            $resp = $resp->withStatus(201);
            $resp = $resp->withJson(array('question' => array('id' => $id_question, 'texte' => $question->texte, 'id_quizz' => $question->id_quizz)));
            return $resp;
        }catch(ExpiredException $e) {
            $resp = $resp->withStatus(401);
            $resp = $resp->withJson(array('type' => 'error', 'error' => 401, 'message' => "La carte a expirée"));
            return $resp;
        }catch(SignatureInvalidException $e) {
            $resp = $resp->withStatus(401);
            $resp = $resp->withJson(array('type' => 'error', 'error' => 401, 'message' => "Mauvaise signature"));
            return $resp;
        }catch(BeforeValidException $e) {
            $resp = $resp->withStatus(401);
            $resp = $resp->withJson(array('type' => 'error', 'error' => 401, 'message' => "Les informations ne correspondent pas"));
            return $resp;
        }catch(\UnexpectedValueException $e) {
            $resp = $resp->withStatus(401);
            $resp = $resp->withJson(array('type' => 'error', 'error' => 401, 'message' => "Les informations ne correspondent pas"));
            return $resp;
        }
    }

    public function addReponses(Request $req, Response $resp, $args){
        try {
            $secret = "quizzbox";
            $h = $req->getHeader('Authorization')[0];
            $tokenstring = sscanf($h, "Bearer %s")[0];
            $token = JWT::decode($tokenstring, $secret, ['HS512']);
            try{
                User::findOrFail($token->id);
            }catch(ModelNotFoundException $e){
                $resp = $resp->withStatus(401);
                $resp = $resp->withJson(array('type' => 'error', 'error' => 401, 'message' => "Le token ne correspond pas"));
                return $resp;
            }
            $parsedBody = $req->getParsedBody();
            $id_question = Question::select('id')->where('texte', '=', $parsedBody('question'))->get();
            $i=1;
            foreach ($parsedBody['reponses'] as $value) {
                $reponse = new Reponse;
                $reponse->texte = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
                $reponse->id_question = $id_question;
                if ($parsedBody['picked'] == $value) {
                    $reponse->etat = 1;
                }
                else {
                    $reponse->etat = 0;
                }
            $id_reponse = $reponse->save();
            $tabjson['reponse'.$i] = array('id' => $id_reponse, 'texte' => $reponse->texte, 'etat' => $response->etat, 'id_question' => $reponse->id_question);
            $i++;
            }
            
            $resp = $resp->withStatus(201);
            $resp = $resp->withJson(array('reponses' => $tabjson));
            return $resp;
        }catch(ExpiredException $e) {
            $resp = $resp->withStatus(401);
            $resp = $resp->withJson(array('type' => 'error', 'error' => 401, 'message' => "La carte a expirée"));
            return $resp;
        }catch(SignatureInvalidException $e) {
            $resp = $resp->withStatus(401);
            $resp = $resp->withJson(array('type' => 'error', 'error' => 401, 'message' => "Mauvaise signature"));
            return $resp;
        }catch(BeforeValidException $e) {
            $resp = $resp->withStatus(401);
            $resp = $resp->withJson(array('type' => 'error', 'error' => 401, 'message' => "Les informations ne correspondent pas"));
            return $resp;
        }catch(\UnexpectedValueException $e) {
            $resp = $resp->withStatus(401);
            $resp = $resp->withJson(array('type' => 'error', 'error' => 401, 'message' => "Les informations ne correspondent pas"));
            return $resp;
        }
    }
}
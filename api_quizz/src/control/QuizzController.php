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
        $resp = $resp->withHeader('Access-Control-Allow-Origin', $request->getHeader('Origin')[0]);
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

    public function theme(Request $req, Response $resp, $args){
        try {
            $theme = Theme::all();
        } catch (ModelNotFoundException $e) {
            $resp = $resp->withStatus(404);
            $resp = $resp->withJson(array('type' => 'error', 'error' => 404, 'message' => 'Ressource non disponible : /series/'.$args['id']));
            return $resp;
        }
        $tabserie=[
            "type"=>"ressource",
            "meta"=>[$date=date('d/m/y')],
            "serie"=>$theme,
        ];
        $resp = $resp->withStatus(200);
        $resp = $resp->withJson($tabserie);
        return $resp;
    }

    public function quizz(Request $req, Response $resp, $args){
        try {
            $quizz = Quizz::where('id','=',$args['id'])->with('questions')->get();
        } catch (ModelNotFoundException $e) {
            $resp = $resp->withStatus(404);
            $resp = $resp->withJson(array('type' => 'error', 'error' => 404, 'message' => 'Ressource non disponible : /series/'.$args['id']));
            return $resp;
        }
        $tabserie=[
            "type"=>"ressource",
            "meta"=>[$date=date('d/m/y')],
            "quizz"=>$quizz,
        ];
        $resp = $resp->withStatus(200);
        $resp = $resp->withJson($tabserie);
        return $resp;
    }



        /*public function addPhoto(Request $req, Response $resp, $args){
            try {
                $secret = "geoquizz";
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
                $photo = new Photo;
                $photo->url = filter_var($parsedBody['url'], FILTER_SANITIZE_SPECIAL_CHARS);
                $photo->longitude = filter_var($parsedBody['longitude'], FILTER_SANITIZE_SPECIAL_CHARS);
                $photo->latitude = filter_var($parsedBody['latitude'], FILTER_SANITIZE_SPECIAL_CHARS);
                $photo->id_ville = filter_var($parsedBody['id_ville'], FILTER_SANITIZE_SPECIAL_CHARS);
                $photo->save();
                $resp = $resp->withStatus(201);
                $resp = $resp->withJson(array('photo' => array('url' => $photo->url, 'longitude' => $photo->longitude, 'latitude' => $photo->latitude, 'id_ville' => $photo->id_ville)));
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
            }catch(UnexpectedValueException $e) {
                $resp = $resp->withStatus(401);
                $resp = $resp->withJson(array('type' => 'error', 'error' => 401, 'message' => "Les informations ne correspondent pas"));
                return $resp;
            }
        }*/

    /*public function addSerie(Request $req, Response $resp, $args){
        try {
            $secret = "geoquizz";
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
            $serie = new Serie;
            $uuid4 = Uuid::uuid4();
            $serie->id = $uuid4;
            $serie->ville = filter_var($parsedBody['ville'], FILTER_SANITIZE_SPECIAL_CHARS);
            $serie->longitude = filter_var($parsedBody['longitude'], FILTER_SANITIZE_SPECIAL_CHARS);
            $serie->latitude = filter_var($parsedBody['latitude'], FILTER_SANITIZE_SPECIAL_CHARS);
            $serie->save();
            $resp = $resp->withStatus(201);
            $resp = $resp->withJson(array('serie' => array('id' => $serie->id, 'ville' => $serie->ville, 'longitude' => $serie->longitude, 'latitude' => $serie->latitude)));
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
    }*/

    public function getSeries(Request $req, Response $resp, $args){
        
        $series = Serie::all();
        $t = count($series);
        $resp = $resp->withHeader('Content-Type', "application/json;charset=utf-8");
        $tabseries = [
            "type"=>'collection',
            "meta"=>[$date=date('d/m/y'),"count"=>$t],
            "series"=>$series
        ];
        $resp = $resp->withStatus(200);
        $resp = $resp->withJson($tabseries);
        
        return $resp;
    }
}
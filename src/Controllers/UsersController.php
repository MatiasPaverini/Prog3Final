<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\User as user;

use Utils\UserTypes as types;
use Utils\Auth as auth;

class UsersController {

    public function getAll(Request $request, Response $response, $args)
    {
        $rta = json_encode(user::all());

        $response->getBody()->write($rta);

        return $response;
    }

    public function add(Request $request, Response $response, $args)
    {
        $user = new user;

        $options = [
            $salt = "progra3"
        ];

        $body = json_decode($request->getBody());

        $user->user = $body->user;
        $user->email = $body->email;
        $user->type = $this->setType($body->type);
        $user->pass = password_hash($body->pass, PASSWORD_DEFAULT, $options);
        
        $rta;
        $resCode = 500;

        if(types::isTypeInt($user->type) && !$this->emailExists($user->email) &&
            !$this->checkName($user->user) && $this->checkPassword($user->pass)) {
            
                $rta = json_encode(array("message" => $user->save(), "id" => $user->id));
                $resCode = 201;
        }
        else {
            $rta = json_encode(array("message" => "Tiene datos erroneos."));
            $resCode = 400;
        }
        $response->getBody()->write($rta);

        return $response->withStatus($resCode);
    }

    public function login(Request $request, Response $response, $args) 
    {
        $body = json_decode($request->getBody());

        $login = new user;
        
        
        $login->user = $body->user;
        $login->pass = $body->pass;
        
        $user = user::where('user', '=', $login->user)->first();
        
        $rta;
        $isValidPass = password_verify($login->pass, $user->pass);
        $resCode = 500;
        if($isValidPass)
        {
            $rta = json_encode(array("message" => "Bienvenido $login->user", "token" => auth::create($user)));
            $resCode = 200;
        }
        else {
            $rta = json_encode(array("message" => "Usuario o contraseña erronea."));
            $resCode = 400;
        }
        
        $response->getBody()->write($rta);

        return $response->withStatus($resCode);
    }

    private function emailExists(string $email) :string {
        $emails = user::all();
        foreach ($emails as $dbEmail => $value) {
            if ($value->email == $email) {
                return true;
            }
        }
        return false;
    }

    private function checkPassword(string $pass) {
        
        if (strlen($pass) > 4) {
            return true;
        }
        return false;
    }

    private function checkName(string $name) {
        $names = user::all();
        foreach ($names as $dbName => $value) {
           if($value->nombre != $name && strpos($name, ' ') != false) {
                return true;
           }
        }
        return false;
    }

    /**
     * Toma el valor del body correspondiente al tipo
     * 
     * @param  "dinamico" $type - Valor dinámico, puede ser un string o un número
     * 
     * @return int $result - Id del valor enviado, si es un tipo no válido tira error.
     * 
     */
    private function setType($type) :int{
        $result;
        if(types::isTypeString($type)) {
            $result = types::convertToInt($type);

        } else if (types::isTypeInt($type)) {
            $result = $type;
        }
    }
}
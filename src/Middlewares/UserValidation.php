<?php
namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

use Utils\Auth as auth;


class UserValidation
{
    /**
     * Example middleware invokable class
     *
     * @param  ServerRequest  $request PSR-7 request
     * @param  RequestHandler $handler PSR-15 request handler
     *
     * @return Response
     */
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        
        $tokenHeader = $request->getHeader('token');
        $resCode = 200;
        $valid = auth::checkToken($tokenHeader[0]);
        $tokenData;

        if ($valid) {
            $tokenData = auth::getData($tokenHeader[0]);
        }
        else {
            $response->getBody()->write(json_encode(array("message" => 'Token inválido')));
            return $response->withStatus($resCode);
        }
        if($tokenData->type == 1) {
            $data = [
                'id' => $tokenData->id,
                'user' => $tokenData->user,
                'type' => $tokenData->type,
                'pass' => $tokenData->pass
            ];
            $request->withAttribute('userId', $tokenData->type);
            $response = $handler->handle($request->withAttribute('userId', $tokenData->type));
            $existingContent = (string) $response->getBody();
        } else {
            $response = new Response();
            $response->getBody()->write(json_encode(array("message" => 'No es User')));
            $resCode = 401;
            return $response->withStatus($resCode);
        }
        
        //$response->getBody()->write('BEFORE ' . $existingContent);

        return $response;
    }
}

<?php
namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

use Utils\Auth as auth;

class TokenValidation
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
        
        if ($valid) {
            
            $response = $handler->handle($request);
            $existingContent = (string) $response->getBody();
            $response = new Response();
            $response->getBody()->write($existingContent);
        } else {
            $response->getBody()->write(json_encode(array("message" => 'Token Inválido ')));
            $resCode = 401;
            return $response->withStatus($resCode);
        }
        
        //$response->getBody()->write('BEFORE ' . $existingContent);

        return $response;
    }
}

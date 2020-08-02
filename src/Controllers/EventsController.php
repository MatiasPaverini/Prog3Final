<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Event as event;
use App\Models\User as user;

use Utils\Auth as auth;

class EventsController {

    public function getAll(Request $request, Response $response, $args)
    {
        $event = new event;
        $tokenData = auth::getData($request->getHeader('token')[0]);
        $events;

        if($tokenData->type == 0) {
            $events = $event->orderby('userId', 'desc')->orderby('date', 'desc')->get();
        }
        else {

            $user = user::where('user', '=', $tokenData->user)->first();
            $events = $event->where('userId', '=', $user->id)->orderBy('date', 'desc')->get();
        }
        $rta = json_encode($events);

        $response->getBody()->write($rta);

        return $response;
    }

    public function add(Request $request, Response $response, $args)
    {
        $event = new event;
        $tokenData = auth::getData($request->getHeader('token')[0]);
        $body = json_decode($request->getBody());
        $event->desc = $body->desc;
        $event->date = new \Datetime('now');
        $event->userId = $tokenData->id;

        $rta = json_encode(array("message" => $event->save(), 'id' => $event->id));
        $response->getBody()->write($rta);

        return $response->withStatus(201);
    }

    public function update(Request $request, Response $response, $args)
    {
 
        $event = event::find($args['id']);
        $event->date = new \Datetime('now');
        $tokenData = auth::getData($request->getHeader('token')[0]);



        $rta = \json_encode(array("message" => $event->save(),'event' => $event));

        $response->getBody()->write($rta);

        return $response->withStatus(200);
    }
}
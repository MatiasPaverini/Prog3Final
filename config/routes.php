<?php

use Slim\Routing\RouteCollectorProxy;

//Include Controllers
use App\Controllers\PetTypesController;
use App\Controllers\PetController;
use App\Controllers\UsersController;
use App\Controllers\EventsController;

//Include middlewares
use App\Middleware\UserValidation;
use App\Middleware\AdminValidation;
use App\Middleware\TokenValidation;

return function ($app) {

    $app->group('/users', function (RouteCollectorProxy $group) {
        $group->post('[/]', UsersController::class . ':add');
        $group->get('[/]', UsersController::class . ':getAll');
        $group->get('/:id', UsersController::class . ':getById');
        $group->put('[/]', UsersController::class. ':update')->add(new UserValidation());
        $group->post('/login', UsersController::class . ':login');
        $group->get('/logs', UsersController::class. ':logs')->add(new AdminValidation());
    });

    $app->group('/events', function (RouteCollectorProxy $group) {
        $group->post('[/]', EventsController::class . ':add')->add(new UserValidation());
        $group->get('[/]', EventsController::class . ':getAll')->add(new TokenValidation());
        $group->put('/{id}', EventsController::class . ':update')->add(new UserValidation());
        $group->get('/:id', EventsController::class . ':get');
    });

    $app->group('/logs', function (RouteCollectorProxy $group) {
        $group->get('[/]', LogsController::class. ':getAll');
        
    })->add(new UserValidation());

};
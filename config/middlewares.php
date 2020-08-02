<?php
use Slim\App;
use App\Middleware\MwJsonResponse;


return function (App $app) {
    $app->addBodyParsingMiddleware();

    
    $app->add(new MwJsonResponse());
    
};
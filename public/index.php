<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\AppFactory;
use Slim\Psr7\Response;
//use DI\Container;
require __DIR__ . '/../vendor/autoload.php';

include __DIR__ . '/../bootstrap/env.php';
$app = include __DIR__ . '/../bootstrap/bootstrap.php';

include __DIR__ . '/../app/routes.php';
$app->run();

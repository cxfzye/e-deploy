<?php
use Slim\Routing\RouteCollectorProxy;

$app->get('/', [\App\Controller\Index::class, 'index']);


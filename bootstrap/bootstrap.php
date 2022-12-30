<?php
// DIC configuration
use \Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use DI\Container;
use Slim\Factory\AppFactory;
define('ROOT_DIR',  __DIR__ . '/../');
define('LOG_DIR',  ROOT_DIR . 'logs/');
define('RUNTIME_DIR',  ROOT_DIR . 'runtime/');
define('COMMON_ERROR_LOG', RUNTIME_DIR . 'common_error.log');

/** @var  $container */
require __DIR__ . '/../vendor/autoload.php';
$container = new Container();
$container->set('settings', function () {
    $settings = require(__DIR__ . '/../config/settings.php');
    return $settings;
});

AppFactory::setContainer($container);
$app = AppFactory::create();

if (!env('APP_DEBUG', false)) {
    $errorHandler = function (
        ServerRequestInterface $request,
        Throwable $exception,
        bool $displayErrorDetails,
        bool $logErrors,
        bool $logErrorDetails
    ) use ($app) {
        $payload['code'] = 0;
        $payload['err_code'] = $exception->getCode();
        $payload['msg'] = $exception->getMessage();

        $response = $app->getResponseFactory()->createResponse();
        $response->getBody()->write(
            json_encode($payload, JSON_UNESCAPED_UNICODE)
        );
        return $response;
    };

    $errorMiddleware = $app->addErrorMiddleware(true, true, true);
    $errorMiddleware->setDefaultErrorHandler($errorHandler);
}

return $app;



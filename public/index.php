<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;


require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', 'App\Controller\HomeController:index');

$app->get('/employees', function (Request $request, Response $response, $args) {
  $response->getBody()->write("employees");
  return $response;
});

$app->run();

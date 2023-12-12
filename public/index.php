<?php
// use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

use App\Controller\HomeController;

require_once __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/../src/definitions.php');
$container = $containerBuilder->build();

AppFactory::setContainer($container);
$app = AppFactory::create();


$app->get('/', function (Request $request, Response $response, $args) use ($container) {
  $homeController = $container->get(HomeController::class);
  return $homeController->index($request, $response, $args);
});

$app->get('/employees', function (Request $request, Response $response, $args) {
  $response->getBody()->write("employees");
  return $response;
});

$app->run();

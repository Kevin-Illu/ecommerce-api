<?php
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use App\System\Config;


require_once __DIR__ . '/../vendor/autoload.php';


$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/../src/definitions.php');
$container = $containerBuilder->build();


AppFactory::setContainer($container);
$app = AppFactory::create();


$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();


$errorSettings = $container->get(Config::class)->getErrorSettings();
$errorMiddleware = $app->addErrorMiddleware(
  $errorSettings['displayErrorDetails'], 
  $errorSettings['logErrors'], 
  $errorSettings['logErrorDetails']
);


require_once __DIR__ . '/../src/V1/Routes/index.php';


$app->run();


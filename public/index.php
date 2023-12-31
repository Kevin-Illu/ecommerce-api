<?php
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Dotenv\Dotenv;


use App\System\Config;


require_once __DIR__ . '/../vendor/autoload.php';


$dotenv = Dotenv::createImmutable(__DIR__."/../");
$dotenv->load();


$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/../src/definitions.php');
$container = $containerBuilder->build();


AppFactory::setContainer($container);
$app = AppFactory::create();
$app->setBasePath('/apps/api/public');


$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();


$errorSettings = $container->get(Config::class)->getErrorSettings();
$errorMiddleware = $app->addErrorMiddleware(
  $errorSettings['displayErrorDetails'], 
  $errorSettings['logErrors'], 
  $errorSettings['logErrorDetails']
);


// --- routes ---
require_once __DIR__ . '/../src/V1/Routes/Index.php';
require_once __DIR__ . '/../src/V1/Routes/ProductsRouter.php';


$app->run();


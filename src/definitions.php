<?php
namespace App;

use DI\Container;
use function DI\create;
use function DI\get;


use App\System\Config;
use App\System\DB;

use App\Routes\Router;

use App\Controller\HomeController;

return [
  # config
  Config::class => create(),
  DB::class => create()
        ->constructor(get(Config::class)),

  # router
  Router::class => create()
        ->constructor(get(Container::class)),

  # controllers
  HomeController::class => create()
        ->constructor(get(DB::class)),
];


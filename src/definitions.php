<?php
namespace App;

use function DI\create;
use function DI\get;

use App\System\Config;
use App\System\DB;

use App\Controller\HomeController;

return [
  # config
  Config::class => create(),
  DB::class => create()
        ->constructor(get(Config::class)),

  # controllers
  HomeController::class => create()
        ->constructor(get(DB::class)),
];

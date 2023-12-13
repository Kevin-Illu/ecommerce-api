<?php
namespace App;

use function DI\create;
use function DI\get;


use App\System\Config;
use App\System\DB;

# repositories
use App\Repositories\ProductRepository;
# services
use App\Services\ProductService;
# controllers
use App\Controllers\HomeController;

return [
  # config
  Config::class => create(),
  DB::class => create()
        ->constructor(get(Config::class)),

  # repositories
  ProductRepository::class => create()
    ->constructor(get(DB::class)),

  # services
  ProductService::class => create()
    ->constructor(get(ProductRepository::class)),

  # controllers
  HomeController::class => create(),
];


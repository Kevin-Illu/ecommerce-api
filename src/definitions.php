<?php
namespace App;

use function DI\create;
use function DI\get;

use App\System\Config;
use App\System\DB;

# repositories
use App\Repositories\ProductsRepository;
# services
use App\Services\ProductsService;
# controllers
use App\Controllers\HomeController;
use App\Controllers\ProductsController;

return [
  # config
  Config::class => create(),
  DB::class => create()
        ->constructor(get(Config::class)),

  # repositories
  ProductsRepository::class => create()
    ->constructor(get(DB::class)),

  # services
  ProductsService::class => create()
    ->constructor(get(ProductsRepository::class)),

  # controllers
  HomeController::class => create(),
  ProductsController::class => create()
    ->constructor(get(ProductsService::class)),
];



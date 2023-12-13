<?php
namespace App\V1\Routes;

use App\Controllers\ProductsController;

require_once __DIR__ . '/../../../public/index.php';

$app->get('/api/v1/products', ProductsController::class .':index');
$app->get('/api/v1/products/featured', ProductsController::class . ':getFeaturedProducts');
$app->get('/api/v1/products/{code}', ProductsController::class . ':getProductByCode');


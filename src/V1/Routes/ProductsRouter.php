<?php
namespace App\V1\Routes;

use App\Controllers\ProductsController;

require_once __DIR__ . '/../../../public/index.php';
require_once __DIR__ . '/../../Middlewares/ProductsDataValidator.php';

$baseRoute = "/api/v1";

# get all products
$app->get($baseRoute . '/products', ProductsController::class .':index');

# get product by code
$app->get($baseRoute . '/product/{code}', ProductsController::class . ':getProduct');

# update product
$app->put($baseRoute . '/product/{code}', ProductsController::class . ':updateProduct')
  ->add($validateUpdateProductData);

# delete product
$app->delete($baseRoute . '/product/{code}', ProductsController::class . ':deleteProduct');

# add new product
$app->post($baseRoute . '/product/add', ProductsController::class . ':addNewProduct')
  ->add($validateAddProductData);

# get featured products
$app->get($baseRoute . '/products/featured', ProductsController::class . ':getFeaturedProducts');


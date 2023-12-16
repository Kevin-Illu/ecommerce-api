<?php
namespace App\V1\Routes;

use App\Controllers\ProductsController;

require_once __DIR__ . '/../../../public/index.php';
require_once __DIR__ . '/../../Middlewares/ProductsDataValidator.php';
require_once __DIR__ . '/../../Middlewares/AuthMiddleware.php';

$baseRoute = "/api/v1";

# get all products
$app->get($baseRoute . '/products', ProductsController::class .':index')
  ->add($verifyApiKey);

# get product by code
$app->get($baseRoute . '/product/{code}', ProductsController::class . ':getProduct')
  ->add($verifyApiKey);

# update product
$app->put($baseRoute . '/product/{code}', ProductsController::class . ':updateProduct')
  ->add($validateUpdateProductData)
  ->add($verifyApiKey);

# delete product
$app->delete($baseRoute . '/product/{code}', ProductsController::class . ':deleteProduct')
  ->add($verifyApiKey);

# add new product
$app->post($baseRoute . '/product/add', ProductsController::class . ':addNewProduct')
  ->add($validateAddProductData)
  ->add($verifyApiKey);

# get featured products
$app->get($baseRoute . '/products/featured', ProductsController::class . ':getFeaturedProducts')
->add($verifyApiKey);


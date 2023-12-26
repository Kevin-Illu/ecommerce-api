<?php
namespace App\V1\Routes;

use App\Controllers\ProductsController;

require_once __DIR__ . '/../../../public/index.php';

// middlewares
require_once __DIR__ . '/../../Middlewares/SchemaValidator/ProductsDataValidator.php';
require_once __DIR__ . '/../../Middlewares/Jwt/JwtValidator.php';

$baseRoute = "/api/v1";

# get all products
$app->get($baseRoute . '/products', ProductsController::class .':index')
  ->add($jwtValidator);

# get product by code
$app->get($baseRoute . '/product/{code}', ProductsController::class . ':getProduct')
  ->add($jwtValidator);

# update product
$app->put($baseRoute . '/product/{code}', ProductsController::class . ':updateProduct')
  ->add($jwtValidator)
  ->add($validateUpdateProductData);

# delete product
$app->delete($baseRoute . '/product/{code}', ProductsController::class . ':deleteProduct')
  ->add($jwtValidator);

# add new product
$app->post($baseRoute . '/product/add', ProductsController::class . ':addNewProduct')
  ->add($jwtValidator)
  ->add($validateAddProductData);

# get featured products
$app->get($baseRoute . '/products/featured', ProductsController::class . ':getFeaturedProducts')
  ->add($jwtValidator);


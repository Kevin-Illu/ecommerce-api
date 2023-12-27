<?php
namespace App\V1\Routes;

use App\Controllers\ProductsController;

require_once __DIR__ . '/../../../public/index.php';

// middlewares
require_once __DIR__ . '/../../Middlewares/SchemaValidator/ProductsDataValidator.php';
require_once __DIR__ . '/../../Middlewares/Jwt/JwtValidator.php';


# get all products
$app->get('/products', ProductsController::class .':index');

# get product by code
$app->get('/product/{code}', ProductsController::class . ':getProduct');

# update product
$app->put('/product/{code}', ProductsController::class . ':updateProduct')
  ->add($jwtValidator)
  ->add($validateUpdateProductData);

# delete product
$app->delete('/product/{code}', ProductsController::class . ':deleteProduct')
  ->add($jwtValidator);

# add new product
$app->post('/product/add', ProductsController::class . ':addNewProduct')
  ->add($jwtValidator)
  ->add($validateAddProductData);

# get featured products
$app->get('/products/featured', ProductsController::class . ':getFeaturedProducts');


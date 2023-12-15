<?php
namespace App\V1\Routes;

use App\Controllers\ProductsController;

require_once __DIR__ . '/../../../public/index.php';
require_once __DIR__ . '/../../Middlewares/productDataValidator.php';

# get all products
$app->get('/api/v1/products', ProductsController::class .':index');

# get product by code
$app->get('/api/v1/product/{code}', ProductsController::class . ':getProduct');

# add new product
$app->post('/api/v1/product/add', ProductsController::class . ':addNewProduct')
  ->add($validateAddProductData);

# update product
$app->put('/api/v1/product/{code}', ProductsController::class . ':updateProduct')
  ->add($validateUpdateProductData);

# delete product
$app->delete('/api/v1/product/{code}', ProductsController::class . ':deleteProduct');

# get all featured products
$app->get('/api/v1/products/featured', ProductsController::class . ':getFeaturedProducts');


<?php
namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

require_once __DIR__ . '/ProductSchemas.php';

$middleware = new DataValidator();
$addSchema = $schemas['add'];
$updateSchema = $schemas['update'];

$validateUpdateProductData = function (Request $request, RequestHandler $handler) use ($addSchema, $middleware) {
  return $middleware->validateSchema($request, $handler, $addSchema);
};

$validateAddProductData = function (Request $request, RequestHandler $handler) use ($updateSchema, $middleware) {
  return $middleware->validateSchema($request, $handler, $updateSchema);
};


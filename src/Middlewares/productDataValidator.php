<?php
namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

require_once __DIR__ . '/validateSchema.php';

$addProductSchema = <<<'JSON'
{
  "type": "object",
  "properties": {
    "productCode": { "type": "string" },
    "productName": { "type": "string" },
    "productDescription": { "type": "string" },
    "buyPrice": { "type": "string" },
    "quantityInStock": { "type": "integer" },
    "productScale": { "type": "string" },
    "productVendor": { "type": "string" },
    "productLine": { "type": "string" },
    "MSRP": { "type": "string" }
  },
  "required": [
    "productCode",
    "productName",
    "productDescription",
    "buyPrice",
    "quantityInStock",
    "productScale",
    "productVendor",
    "productLine",
    "MSRP"
  ]
}
JSON;

$updateProductSchema = <<<'JSON'
{
  "type": "object",
  "properties": {
    "productName": { "type": "string" },
    "productDescription": { "type": "string" },
    "buyPrice": { "type": "string" },
    "quantityInStock": { "type": "integer" },
    "productScale": { "type": "string" },
    "productVendor": { "type": "string" },
    "productLine": { "type": "string" },
    "MSRP": { "type": "string" }
  },
  "required": [
    "productCode",
    "productName",
    "productDescription",
    "buyPrice",
    "quantityInStock",
    "productScale",
    "productVendor",
    "productLine",
    "MSRP"
  ]
}
JSON;

$validateAddProductData = function (Request $request, RequestHandler $handler) use ($validateSchema, $addProductSchema) {
    return $validateSchema($request, $handler, $addProductSchema);
};

$validateUpdateProductData = function (Request $request, RequestHandler $handler) use ($validateSchema, $updateProductSchema) {
    return $validateSchema($request, $handler, $updateProductSchema);
};



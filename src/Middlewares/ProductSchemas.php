<?php
namespace App\Middlewares;

$addSchema = <<<'JSON'
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

$updateSchema = <<<'JSON'
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

$schemas = [
  "add" => $addSchema,
  "update" => $updateSchema
];

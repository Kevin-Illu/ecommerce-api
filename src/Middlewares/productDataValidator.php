<?php
namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as Response;
use JsonSchema\Validator as Validator;

$ProductDataValidator = function(Request $request, RequestHandler $handler) {
  $jsonSchema = <<<'JSON'
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

  $jsonSchemaObject = json_decode($jsonSchema);

  $validator = new Validator();
  $data = $request->getParsedBody();

  $dataObject = json_decode(json_encode($data));

  $validator->validate($dataObject, $jsonSchemaObject);

  # in case the request is not valid
  if(!$validator->isValid()) {
    $response = new Response();
    $response->getBody()->write(json_encode($validator->getErrors()));

    return $response->withHeader('content-type', 'application/json');
  }

  $response = $handler->handle($request);
  return $response;
};

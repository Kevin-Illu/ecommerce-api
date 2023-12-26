<?php
namespace App\Middlewares\SchemaValidator;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

$authSchema = <<<'JSON'
{
  "type": "object",
  "properties": {
    "email": { "type": "string" },
    "password": { "type": "string" }
  },
  "required": [
    "email",
    "password"
  ]
}
JSON;

$middleware = new DataValidator();

$validateAuthSchema = function (Request $request, RequestHandler $handler) use ($authSchema, $middleware) {
  return $middleware->validateSchema($request, $handler, $authSchema);
};


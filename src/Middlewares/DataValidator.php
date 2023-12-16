<?php
namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as Response;
use JsonSchema\Validator as Validator;


class DataValidator {
  /**
   * Validates product data against a JSON schema.
   *
   * @param Request $request The received HTTP request.
   * @param RequestHandler $handler The HTTP request handler.
   * @param string $jsonSchema The JSON schema against which the product data will be validated.
   *
   // * @return Response The HTTP response with the validation result.
   */
  public function validateSchema (Request $request, RequestHandler $handler, string $jsonSchema) {
    $jsonSchemaObject = json_decode($jsonSchema);

    $validator = new Validator();
    $data = $request->getParsedBody();
    $dataObject = json_decode(json_encode($data));

    $validator->validate($dataObject, $jsonSchemaObject);

    if (!$validator->isValid()) {
      $response = new Response();
      $response->getBody()->write(json_encode($validator->getErrors()));

      return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
    }

    return $handler->handle($request);
  }
}


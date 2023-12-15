<?php
namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as Response;
use JsonSchema\Validator as Validator;


$validateSchema = function (Request $request, RequestHandler $handler, string $jsonSchema) {
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
};


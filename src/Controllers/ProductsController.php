<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class ProductsController implements ControllerInterface {
  public function index(Request $request, Response $response, $args): Response {
    $payload = [
      'version' => '1.0',
      'resources' => []
    ];

    $response->getBody()->write(json_encode($payload));
    return $response->withHeader('Content-Type', 'application/json');
  }

}


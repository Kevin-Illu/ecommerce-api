<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class HomeController implements ControllerInterface {

  public function index(Request $request, Response $response, $args): Response {
    $res = array('title' => 'home');
    $response->getBody()->write(json_encode($res));

    return $response->withHeader('Content-Type', 'application/json');
  }
}

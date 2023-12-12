<?php
namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

interface ControllerInterface {
  /**
  * @param Request $request
  * @param Response $response
  * @param array $args
  * @return Response
  */
  public function index(Request $request, Response $response, array $args): Response;
};

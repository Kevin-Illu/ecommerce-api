<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


$app->get('/', function (Request $request, Response $response, $args) {
  $user = array('id' => 1, 'name' => 'kevin');
  $response->getBody()->write(json_encode($user));

  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/employees', function (Request $request, Response $response, $args) {
  $response->getBody()->write("employees");
  return $response;
});



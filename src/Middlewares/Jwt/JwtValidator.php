<?php
namespace App\Middlewares\Jwt;

use App\Middlewares\Jwt\JwtMiddleware;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;


$jwtValidator = function (Request $request, RequestHandler $handler) {
  $validator = new JwtMiddleware();
  return $validator->verifyToken($request, $handler);
};



<?php
namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

require_once __DIR__  . '/../../public/index.php';

$jwtMiddleware = function (Request $request, RequestHandler $handler) {
  $middleware = new JwtMiddleware();
  return $middleware->verifyToken($request, $handler);
};


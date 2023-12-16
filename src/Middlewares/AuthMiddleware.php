<?php
namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

require_once __DIR__  . '/../../public/index.php';


$verifyApiKey = function (Request $request, RequestHandler $handler) {
  global $authMiddleware; # viene de el contenedor
  return $authMiddleware->verifyApiKey($request, $handler);
};


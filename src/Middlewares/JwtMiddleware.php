<?php
namespace App\Middlewares;

use Slim\Psr7\Response;
use App\Middlewares\JwtAuth;

// Middleware para verificar el token antes de acceder a las rutas protegidas
$verifyToken = function ($request, $handler) {
  $token = $request->getHeaderLine('Authorization');

  // El token no está presente en la solicitud
  if (!$token) {
    return new Response(401, [], 'Unauthorized');
  }

  JwtAuth::$key = $_ENV['JWT_SECRET'];
  $decoded = JwtAuth::verifyToken($token);

  // Token inválido o expirado
  if (!$decoded) {
    return new Response(401, [], 'Unauthorized');
  }

  // Token válido, continúa con la solicitud
  return $handler->handle($request);
};

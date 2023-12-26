<?php
namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use App\Middlewares\JwtAuth;
use Slim\Psr7\Response as SlimResponse;

class JwtMiddleware
{

  public function verifyToken(Request $request, RequestHandler $handler): Response
  {
    $authorizationHeader = $request->getHeaderLine('Authorization');

    // El token no está presente en la solicitud
    if (empty($authorizationHeader)) {
      $response = [
        'status' => 'error',
        'message' => 'Unauthorized - Token missing',
      ];

      return $this->sendErrorResponse($response);
    }

    // Verificar que el encabezado comience con 'Bearer '
    if (strpos($authorizationHeader, 'Bearer ') !== 0) {
      $response = [
        'status' => 'error',
        'message' => 'Invalid Authorization header format',
      ];

      return $this->sendErrorResponse($response);
    }

    // Extraer el token de la cadena del encabezado
    $token = substr($authorizationHeader, 7); // "Bearer " tiene 7 caracteres

    JwtAuth::$key = $_ENV['JWT_KEY'];
    $result = JwtAuth::verifyToken($token);

    // Verificar el resultado del token
    switch ($result['status']) {
      case 'success':
        // Token válido, continúa con la solicitud
        return $handler->handle($request);

      case 'error':
        // Token inválido o expirado
        $response = [
          'status' => 'error',
          'message' => $result['message'],
        ];
        return $this->sendErrorResponse($response);

      default:
      // Caso inesperado
      $response = [
        'status' => 'error',
        'message' => 'Unexpected error during token verification',
      ];
      return $this->sendErrorResponse($response);
    }
  }

  private function sendErrorResponse($error): Response
  {
    $response = new SlimResponse(); // Usar la implementación de Slim Response
    $response->getBody()->write(json_encode($error));
    $newResponse = $response->withStatus(401);
    return $newResponse;
  }
}


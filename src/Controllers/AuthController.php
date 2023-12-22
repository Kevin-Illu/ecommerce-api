<?php
namespace App\Controllers;

use App\Services\AuthService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class AuthController implements ControllerInterface {
  private AuthService $service;

  public function __construct(AuthService $service) {
    $this->service = $service;
  }

  public function index(Request $request, Response $response, $args): Response {
    $parsedBody = $request->getParsedBody();

    $userEmail = $parsedBody['email'];
    $password = $parsedBody['password'];

    $token = null;
    $data = [
        "email" => $userEmail,
        "password" => $password
    ];

    $isUserAuthenticated = $this->service->authenticateUser($userEmail, $password);

    if ($isUserAuthenticated)
    {
      $authenticationToken = $this->service->generateToken($data);
    }

    $responseBody = [
        "email" => $userEmail,
        "token" => $authenticationToken
    ];

    $response->getBody()->write(json_encode($responseBody));
    return $response->withHeader('Content-Type', 'application/json');
  }
}

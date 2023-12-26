<?php
namespace App\Services;

use App\Repositories\UserRepository;
use App\Middlewares\JwtAuth;

/**
 * Class ProductsService
 * @package App\Services
 */
class AuthService {
  private UserRepository $repo;

  /**
   * ProductsService constructor.
   * @param UserRepository $repo
   */
  public function __construct(UserRepository $repo) {
    $this->repo = $repo;
  }

  public function authenticateUser($email, $password) {
    $result = $this->repo->getPasswordByEmail($email);

    if (!$result) {
      return [
        "result" => false,
        "msg" => "Authentication failed"
      ];
    }

    $hashedPassword = $result['password'];
    $isPasswordValid = password_verify($password, $hashedPassword);

    return [
      "result" => $isPasswordValid,
      "msg" => $isPasswordValid ? "Authentication successful" : "Authentication failed"
    ];
  }


  public function generateToken($data) {
    JwtAuth::setKey($_ENV['JWT_KEY']);
    return JwtAuth::generateToken($data);
  }
}


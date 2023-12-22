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

    if (!$result)
    {
      return false;
    }

    $hashedPassword = $result['password'];

    return password_verify($password, $hashedPassword);
  }

  public function generateToken($data) {
    JwtAuth::setKey($_ENV['JWT_KEY']);
    return JwtAuth::generateToken($data);
  }
}


<?php

namespace App\Middlewares;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;

class JwtAuth {
  public static $key;
  private static $defaultAlgorithm = 'HS256';

  public static function setKey($key)
  {
    self::$key = $key;
  }

  public static function generateToken($data, $expiration = null, $algorithm = null)
  {

    $algorithm = $algorithm ?: self::$defaultAlgorithm;

    if ($expiration) {
      $data['exp'] = $expiration;
    }

    $token = JWT::encode($data, self::$key, $algorithm);
    return $token;
  }

  public static function verifyToken($token, $algorithm = null)
  {
    $algorithm = $algorithm ?: self::$defaultAlgorithm;

    $result = [
      'status' => null,
      'response' => null,
      'message' => null,
    ];

    try {
      $decoded = JWT::decode($token, new Key(self::$key, $algorithm));
      $result['status'] = 'success';
      $result['response'] = $decoded;
      $result['message'] = 'Token decoded successfully';
    } catch (\Firebase\JWT\ExpiredException $e) {
      $result['status'] = 'error';
      $result['message'] = 'Token expired';
    } catch (\Firebase\JWT\SignatureInvalidException $e) {
      $result['status'] = 'error';
      $result['message'] = 'Invalid signature';
    } catch (\Firebase\JWT\BeforeValidException $e) {
      $result['status'] = 'error';
      $result['message'] = 'Before valid date';
    }

    return $result;
  }
}


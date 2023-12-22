<?php

namespace App\Middlewares;

use Firebase\JWT\JWT;

class JwtAuth {
    private static $key;
    private static $defaultAlgorithm = 'HS256';

    public static function setKey($key)
    {
        self::$key = $key;
    }

    public static function generateToken($data, $algorithm = null)
    {
        $algorithm = $algorithm ?: self::$defaultAlgorithm;
        $token = JWT::encode($data, self::$key, $algorithm);
        return $token;
    }

    public static function verifyToken($token, $algorithm = null)
    {
        $algorithm = $algorithm ?: self::$defaultAlgorithm;

        try {
            $decoded = JWT::decode($token, self::$key, [$algorithm]);
            return $decoded;
        } catch (\Exception $e) {
            // Handle exceptions (token expired, invalid signature, etc.)
            return $e->getMessage();
        }
    }
}


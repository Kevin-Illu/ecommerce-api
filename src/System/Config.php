<?php
namespace App\System;

class Config {
  private $dbSettings;
  private $errorSettings;

  public function __construct() {
    $host = getenv('DB_HOST');
    $db   = getenv('DB_DATABASE');
    $user = getenv('DB_USERNAME');
    $pass = getenv('DB_PASSWORD');


    $this->dbSettings = [
      'dbname' => $db,
      'user' => $user,
      'password' => $pass,
      'host' => $host,
      'driver' => 'pdo_mysql'
    ];
  }
 
  public function getDbConfig(): array {
    return $this->dbSettings;
  }
}

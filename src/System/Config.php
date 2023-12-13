<?php
namespace App\System;

require __DIR__.'/../../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__."/../../");
$dotenv->load();


class Config {
  private $dbSettings;
  private $errorSettings;

  public function __construct() {
    $host = $_ENV['DB_HOST'];
    $db   = $_ENV['DB_DATABASE'];
    $user = $_ENV['DB_USERNAME'];
    $pass = $_ENV['DB_PASSWORD'];
    $driver = $_ENV['DB_DRIVER'];


    $this->dbSettings = [
      'dbname' => $db,
      'user' => $user,
      'password' => $pass,
      'host' => $host,
      'driver' => $driver
    ];

    $this->errorSettings = [
      'displayErrorDetails' => true,
      'logErrors' => true,
      'logErrorDetails' => true
    ];
  }
 
  public function getDbConfig(): array {
    return $this->dbSettings;
  }

  public function getErrorSettings(): array {
    return $this->errorSettings;
  }
}

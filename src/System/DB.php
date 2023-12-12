<?php
namespace App\System;

use Doctrine\DBAL\DriverManager as DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;

class DB {
  private $queryBuilder;
  private $conn;
  private $connectionParameters;

  private function __construct(Config $config) {
    $this->connectionParameters = $config->getDbConfig();

    $this->conn = DriverManager::getConnection
    ($this->connectionParameters);

    $this->queryBuilder = $this->conn->createQueryBuilder();
  }

  public function getQueryBuilder(): QueryBuilder {
    return $this->queryBuilder;
  }
}

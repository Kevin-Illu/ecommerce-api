<?php
namespace App\Repositories;

use App\System\DB;

class UserRepository {
  private DB $db;

  public function __construct(DB $db) {
    $this->db = $db;
  }

  public function getPasswordByEmail($email) {
    $queryBuilder = $this->db->getQueryBuilder();
    $queryBuilder
    ->select('password')
    ->from('users')
    ->where('email = ?')
    ->setParameter(0, $email);

    $results = $queryBuilder->executeQuery()->fetchAssociative();
    return $results;
  }
}

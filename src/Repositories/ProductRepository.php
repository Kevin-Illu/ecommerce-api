<?php
namespace App\Repositories;

use App\System\DB;

class ProductRepository {
  private $db;

  public function __construct(DB $db) {
    $this->db = $db;
  }

  public function getFeaturedProducts (int $limit): array {
    $queryBuilder = $this->db->getQueryBuilder();
    $queryBuilder->select('productName, productDescription, buyPrice, quantityInStock, productScale, productVendor')
    ->from('products')
    ->orderBy('RAND()')
    ->setFirstResult($limit)
    ->setMaxResults($limit);

    $results = $queryBuilder->executeQuery()->fetchAll();

    return $results;
  }

  public function getSpecialOffers(int $limit): array {
    $queryBuilder = $this->db->getQueryBuilder();
    $queryBuilder->select('productName, productDescription, buyPrice, quantityInStock, productScale, productVendor, MSRP')
    ->from('products')
    ->where('MSRP - buyPrice > 0')
    ->orderBy('RAND()')
    ->setMaxResults($limit);

    $results = $queryBuilder->executeQuery()->fetchAll();
    return $results;
  }

  // public function getNewArrivals(int $limit): array {
  //
  // }
}

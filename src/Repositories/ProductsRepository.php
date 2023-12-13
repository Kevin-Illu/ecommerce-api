<?php
namespace App\Repositories;

use App\System\DB;

class ProductsRepository {
  private $db;

  public function __construct(DB $db) {
    $this->db = $db;
  }

  public function getFeaturedProducts (int $limit): array {
    $queryBuilder = $this->db->getQueryBuilder();
    $queryBuilder->select('productCode, productName, productDescription, buyPrice, quantityInStock, productScale, productVendor')
    ->from('products')
    ->orderBy('RAND()')
    ->setFirstResult($limit)
    ->setMaxResults($limit);

    $results = $queryBuilder->executeQuery()->fetchAll();

    return $results;
  }

  public function getSpecialOffers(int $limit): array {
    $queryBuilder = $this->db->getQueryBuilder();
    $queryBuilder->select('productCode, productName, productDescription, buyPrice, quantityInStock, productScale, productVendor, MSRP')
    ->from('products')
    ->where('MSRP - buyPrice > 0')
    ->orderBy('RAND()')
    ->setMaxResults($limit);

    $results = $queryBuilder->executeQuery()->fetchAll();
    return $results;
  }

  public function getNewArrivals(int $limit): array {
    $queryBuilder = $this->db->getQueryBuilder();
    $queryBuilder->select('productCode, productName, productDescription, buyPrice, quantityInStock, productScale, productVendor')
    ->from('products')
    ->orderBy('productCode', 'DESC')
    ->setMaxResults($limit);

    return $queryBuilder->executeQuery()->fetchAll();
  }

  public function getAllProducts (int $limit): array {
    $queryBuilder = $this->db->getQueryBuilder();
    $queryBuilder->select('productCode, productName, productDescription, buyPrice, quantityInStock, productScale, productVendor')
    ->from('products')
    ->orderBy('buyPrice', 'ASC');

    $results = $queryBuilder->executeQuery()->fetchAll();
    return $results;
  }
}

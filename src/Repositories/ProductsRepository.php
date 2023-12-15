<?php
namespace App\Repositories;

use App\System\DB;

class ProductsRepository {
  private DB $db;

  public function __construct(DB $db) {
    $this->db = $db;
  }

  public function addNewProduct($product) {
    $queryBuilder = $this->db->getQueryBuilder();
    $queryBuilder->insert('products')
    ->setValue('productCode', '?')
    ->setValue('productName', '?')
    ->setValue('productDescription', '?')
    ->setValue('buyPrice', '?')
    ->setValue('quantityInStock', '?')
    ->setValue('productScale', '?')
    ->setValue('productVendor', '?')
    ->setValue('productLine', '?')
    ->setValue('MSRP', '?')
    ->setParameter(0, $product['productCode'])
    ->setParameter(1, $product['productName'])
    ->setParameter(2, $product['productDescription'])
    ->setParameter(3, $product['buyPrice'])
    ->setParameter(4, $product['quantityInStock'])
    ->setParameter(5, $product['productScale'])
    ->setParameter(6, $product['productVendor'])
    ->setParameter(7, $product['productLine'])
    ->setParameter(8, $product['MSRP']);

    $results = $queryBuilder->executeQuery()->fetchAssociative();

    return $results;
  }

  public function updateProduct($product) {
    $queryBuilder = $this->db->getQueryBuilder();

    $queryBuilder->update('products')
    ->set('productName', '?')
    ->set('productDescription', '?')
    ->set('buyPrice', '?')
    ->set('quantityInStock', '?')
    ->set('productScale', '?')
    ->set('productVendor', '?')
    ->set('productLine', '?')
    ->set('MSRP', '?')
    ->where('productCode = ?')
    ->setParameter(1, $product['productName'])
    ->setParameter(2, $product['productDescription'])
    ->setParameter(3, $product['buyPrice'])
    ->setParameter(4, $product['quantityInStock'])
    ->setParameter(5, $product['productScale'])
    ->setParameter(6, $product['productVendor'])
    ->setParameter(7, $product['productLine'])
    ->setParameter(8, $product['MSRP'])
    ->setParameter(9, $product['productCode']);

    $result = $queryBuilder->executeStatement();

    return $result;
  }

  /**
  * @return array<intr, array<string,mixed>>
  */
  public function getFeaturedProducts (int $limit): array {
    $queryBuilder = $this->db->getQueryBuilder();
    $queryBuilder->select('productCode, productName, productDescription, buyPrice, quantityInStock, productScale, productVendor, productLine, MSRP')
    ->from('products')
    ->orderBy('RAND()')
    ->setFirstResult($limit)
    ->setMaxResults($limit);

    $results = $queryBuilder->executeQuery()->fetchAllAssociative();
    return $results;
  }

  /*
  * @return array<int,array<string,mixed>>
  */
  public function getSpecialOffers(int $limit): array {
    $queryBuilder = $this->db->getQueryBuilder();
    $queryBuilder->select('productCode, productName, productDescription, buyPrice, quantityInStock, productScale, productVendor, productLine, MSRP')
    ->from('products')
    ->where('MSRP - buyPrice > 0')
    ->orderBy('RAND()')
    ->setMaxResults($limit);

    $results = $queryBuilder->executeQuery()->fetchAllAssociative();
    return $results;
  }

  /*
  * @return array<int,array<string,mixed>>
  */
  public function getNewArrivals(int $limit): array {
    $queryBuilder = $this->db->getQueryBuilder();
    $queryBuilder->select('productCode, productName, productDescription, buyPrice, quantityInStock, productScale, productVendor, productLine, MSRP')
    ->from('products')
    ->orderBy('productCode', 'DESC')
    ->setMaxResults($limit);

    $results = $queryBuilder->executeQuery()->fetchAllAssociative();

    return $results;
  }


  /*
  * @return array<int,array<string,mixed>>
  */
  public function getAllProducts (int $limit): array {
    $queryBuilder = $this->db->getQueryBuilder();
    $queryBuilder->select('productCode, productName, productDescription, buyPrice, quantityInStock, productScale, productVendor, productLine, MSRP')
    ->from('products')
    ->orderBy('buyPrice', 'ASC');

    $results = $queryBuilder->executeQuery()->fetchAllAssociative();
    return $results;
  }

  /*
  * @return array<int,array<string,mixed>>
  */
  public function getProductByCode (string $code): array {
    $queryBuilder = $this->db->getQueryBuilder();
    $queryBuilder->select('productCode, productName, productDescription, buyPrice, quantityInStock, productScale, productVendor, productLine, MSRP')
    ->from('products')
    ->where('productCode = ?')
    ->setParameter(0, $code);

    $results = $queryBuilder->executeQuery()->fetchAllAssociative();

    return $results;
  }
}

<?php
namespace App\Repositories;

use App\System\DB;

class ProductsRepository {
  private DB $db;

  public function __construct(DB $db) {
    $this->db = $db;
  }

  /**
   * Add a new product to the database.
   *
   * @param array $product Associative array representing product details.
   * @return array Associative array representing the added product.
   */
  public function addNewProduct($product): array|bool {
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

  /**
   * Update an existing product in the database.
   *
   * @param array $product Associative array representing product details.
   * @return int Number of affected rows.
   */
  public function updateProduct($product): int {
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
    ->setParameter(0, $product['productName'])
    ->setParameter(1, $product['productDescription'])
    ->setParameter(2, $product['buyPrice'])
    ->setParameter(3, $product['quantityInStock'])
    ->setParameter(4, $product['productScale'])
    ->setParameter(5, $product['productVendor'])
    ->setParameter(6, $product['productLine'])
    ->setParameter(7, $product['MSRP'])
    ->setParameter(8, $product['productCode']);

    $result = $queryBuilder->executeStatement();

    return $result;
  }

  /**
   * Get a product by its code.
   *
   * @param string $code Product code.
   * @return array Associative array representing the product.
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


  /**
  * delete a prodcut by its code.
  *
  * @param int $code Product code.
  * @return int
  */
  public function deleteProduct(string $code): int {
    $queryBuilder = $this->db->getQueryBuilder();
    $queryBuilder->delete('products')
    ->where('productCode = ?')
    ->setParameter(0, $code);

    $result = $queryBuilder->executeStatement();

    return $result;
  }

   /**
   * Get all products from the database.
   *
   * @param int $limit The maximum number of products to retrieve.
   * @return array Associative array representing all products.
   */
  public function getAllProducts (int $limit): array {
    $queryBuilder = $this->db->getQueryBuilder();
    $queryBuilder->select('productCode, productName, productDescription, buyPrice, quantityInStock, productScale, productVendor, productLine, MSRP')
    ->from('products')
    ->orderBy('buyPrice', 'ASC');

    $results = $queryBuilder->executeQuery()->fetchAllAssociative();
    return $results;
  }

  /**
   * Get a specified number of featured products.
   *
   * @param int $limit The maximum number of featured products to retrieve.
   * @return array Associative array representing featured products.
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

  /**
   * Get a specified number of special offer products.
   *
   * @param int $limit The maximum number of special offer products to retrieve.
   * @return array Associative array representing special offer products.
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

  /**
   * Get a specified number of new arrival products.
   *
   * @param int $limit The maximum number of new arrival products to retrieve.
   * @return array Associative array representing new arrival products.
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
}

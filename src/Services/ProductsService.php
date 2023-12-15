<?php
namespace App\Services;

use App\Repositories\ProductsRepository;

/**
 * Class ProductsService
 * @package App\Services
 */
class ProductsService {
  /**
   * @var ProductsRepository $repo Products repository instance.
   */
  private ProductsRepository $repo;

  /**
   * ProductsService constructor.
   * @param ProductsRepository $repo
   */
  public function __construct(ProductsRepository $repo) {
    $this->repo = $repo;
  }

  /**
   * Add a new product.
   *
   * @param array $product Associative array representing product details.
   * @return array Associative array representing the added product.
   */
  public function addNewProduct(array $product): array {
    return $this->repo->addNewProduct($product);
  }

  /**
   * Update an existing product.
   *
   * @param array $product Associative array representing product details.
   * @return int Number of affected rows.
   */
  public function updateProduct(array $product): int {
    return $this->repo->updateProduct($product);
  }

  /**
   * Get a product by its code.
   *
   * @param string $code Product code.
   * @return array Associative array representing the product.
   */
  public function getProductByCode(string $code): array {
    return $this->repo->getProductByCode($code);
  }

  /**
   * Get all products.
   *
   * @param int $limit The maximum number of products to retrieve.
   * @return array Associative array representing all products.
   */
  public function getAllProducts(int $limit = 50): array {
    return $this->repo->getAllProducts($limit);
  }

  /**
   * Get a specified number of featured products.
   *
   * @param int $limit The maximum number of featured products to retrieve.
   * @return array Associative array representing featured products.
   */
  public function getFeaturedProducts(int $limit = 10): array {
    return $this->repo->getFeaturedProducts($limit);
  }

  /**
   * Get a specified number of special offer products.
   *
   * @param int $limit The maximum number of special offer products to retrieve.
   * @return array Associative array representing special offer products.
   */
  public function getSpecialOffers(int $limit = 10): array {
    return $this->repo->getSpecialOffers($limit);
  }

  /**
   * Get a specified number of new arrival products.
   *
   * @param int $limit The maximum number of new arrival products to retrieve.
   * @return array Associative array representing new arrival products.
   */
  public function getNewArrivals(int $limit = 10): array {
    return $this->repo->getNewArrivals($limit);
  }
}


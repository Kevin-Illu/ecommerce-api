<?php
namespace App\Services;

use App\Repositories\ProductsRepository;

class ProductsService {
  private ProductsRepository $repo;

  public function __construct(ProductsRepository $repo) {
    $this->repo = $repo;
  }

  public function getFeaturedProducts (int $limit = 10): array {
    return $this->repo->getFeaturedProducts($limit);
  }

  public function addNewProduct($product) {
    return $this->repo->addNewProduct($product);
  }

  // product features
  public function getSpecialOffers(int $limit = 10): array {
    return $this->repo->getSpecialOffers($limit);
  }

  public function getNewArrivals(int $limit = 10):array {
    return $this->repo->getNewArrivals($limit);
  }

  public function getAllProducts(int $limit = 50): array {
    return $this->repo->getAllProducts($limit);
  }

  public function getProductByCode(string $code):array {
    return $this->repo->getProductByCode($code);
  }
}


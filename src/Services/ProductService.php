<?php
namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService {
  private $repo;

  public function __construct(ProductRepository $repo) {
    $this->repo = $repo;
  }

  public function getFeaturedProducts (int $limit): array {
    return $this->repo->getFeaturedProducts($limit);
  }

  public function getSpecialOffers(int $limit): array {
    return $this->repo->getSpecialOffers($limit);
  }
}


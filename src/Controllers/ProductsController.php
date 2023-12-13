<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Services\ProductsService;

class ProductsController implements ControllerInterface {
  private $productsService;

  public function __construct(ProductsService $productsService) {
    $this->productsService = $productsService;
  }

  public function index(Request $request, Response $response, $args): Response {
    $payload = $this->productsService->getAllProducts();
    $response->getBody()->write(json_encode($payload));
    return $response->withHeader('Content-Type', 'application/json');
  }

  public function getSpecialOffers(Request $request, Response $response, $args): Response {
    $payload = $this->productsService->getSpecialOffers();
    $response->getBody()->write(json_encode($payload));
    return $response->withHeader('Content-Type', 'application/json');
  }

  public function getNewArrivals(Request $request, Response $response, $args): Response {
    $payload = $this->productsService->getNewArrivals();
    $response->getBody()->write(json_encode($payload));
    return $response->withHeader('Content-Type', 'application/json');
  }

  public function getFeaturedProducts(Request $request, Response $response, $args): Response {
    $payload = $this->productsService->getFeaturedProducts();
    $response->getBody()->write(json_encode($payload));
    return $response->withHeader('Content-Type', 'application/json');
  }
}


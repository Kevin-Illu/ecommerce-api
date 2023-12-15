<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Services\ProductsService;

class ProductsController implements ControllerInterface {
  private ProductsService $productsService;

  public function __construct(ProductsService $productsService) {
    $this->productsService = $productsService;
  }

  public function index(Request $request, Response $response, $args): Response {
    $payload = $this->productsService->getAllProducts();
    $response->getBody()->write(json_encode($payload));
    return $response->withHeader('Content-Type', 'application/json');
  }

  public function getProduct(Request $request, Response $response, $args): Response {
    $code = $args['code'];
    $payload = $this->productsService->getProductByCode($code);
    $response->getBody()->write(json_encode($payload));

    return $response->withHeader('Content-Type', 'application/json');
  }

  public function addNewProduct(Request $request, Response $response): Response {
    $parsedBody = $request->getParsedBody();
    $product = [
      "productCode" => $parsedBody['productCode'],
      "productName" => $parsedBody['productName'],
      "productDescription" => $parsedBody['productDescription'],
      "buyPrice" => $parsedBody['buyPrice'],
      "quantityInStock" => $parsedBody['quantityInStock'],
      "productScale" => $parsedBody['productScale'],
      "productVendor" => $parsedBody['productVendor'],
      "productLine" => $parsedBody['productLine'],
      "MSRP" => $parsedBody['MSRP'],
    ];

    $payload = $this->productsService->addNewProduct($product);
    $response->getBody()->write(json_encode($payload));

    return $response->withHeader('Content-Type', 'application/json');
  }

  public function updateProduct(Request $request, Response $response, $args): Response  {
    $productCode = $args['code'];
    $parsedBody = $request->getParsedBody();
    $product = [
      "productCode" => $productCode,
      "productName" => $parsedBody['productName'],
      "productDescription" => $parsedBody['productDescription'],
      "buyPrice" => $parsedBody['buyPrice'],
      "quantityInStock" => $parsedBody['quantityInStock'],
      "productScale" => $parsedBody['productScale'],
      "productVendor" => $parsedBody['productVendor'],
      "productLine" => $parsedBody['productLine'],
      "MSRP" => $parsedBody['MSRP'],
    ];

    $payload = $this->productsService->updateProduct($product);
    $response->getBody()->write(json_encode($payload));

    return $response->withHeader('Content-Type', 'application/json');
  }

  public function deleteProduct(Request $request, Response $response, $args): array {
    $payload = ['status' => 'not implemented'];
    $response->getBody()->write(json_encode($payload));

    return $response->withHeader('Content-Type', 'application/json');
  }

  # ---------- product features ----------------

  public function getSpecialOffers(Request $request, Response $response): Response {
    $payload = $this->productsService->getSpecialOffers();
    $response->getBody()->write(json_encode($payload));
    return $response->withHeader('Content-Type', 'application/json');
  }

  public function getNewArrivals(Request $request, Response $response): Response {
    $payload = $this->productsService->getNewArrivals();
    $response->getBody()->write(json_encode($payload));
    return $response->withHeader('Content-Type', 'application/json');
  }

  public function getFeaturedProducts(Request $request, Response $response): Response {
    $payload = $this->productsService->getFeaturedProducts();
    $response->getBody()->write(json_encode($payload));
    return $response->withHeader('Content-Type', 'application/json');
  }
}


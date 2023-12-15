<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Services\ProductsService;


/**
 * Class ProductsController
 * @package App\Controllers
 */
class ProductsController implements ControllerInterface {
   /**
   * @var ProductsService $productsService Product service instance.
   */
  private ProductsService $productsService;

  
  /**
   * ProductsController constructor.
   * @param ProductsService $productsService
   */
  public function __construct(ProductsService $productsService) {
    $this->productsService = $productsService;
  }

  
  /**
   * Get all products.
   *
   * @param Request $request PSR-7 request object.
   * @param Response $response PSR-7 response object.
   * @param array $args Route parameters.
   * @return Response PSR-7 response object.
   */
  public function index(Request $request, Response $response, $args): Response {
    $payload = $this->productsService->getAllProducts();
    $response->getBody()->write(json_encode($payload));
    return $response->withHeader('Content-Type', 'application/json');
  }

  /**
   * Get a product by its code.
   *
   * @param Request $request PSR-7 request object.
   * @param Response $response PSR-7 response object.
   * @param array $args Route parameters.
   * @return Response PSR-7 response object.
   */
  public function getProduct(Request $request, Response $response, $args): Response {
    $code = $args['code'];
    $payload = $this->productsService->getProductByCode($code);
    $response->getBody()->write(json_encode($payload));

    return $response->withHeader('Content-Type', 'application/json');
  }

   /**
   * Add a new product.
   *
   * @param Request $request PSR-7 request object.
   * @param Response $response PSR-7 response object.
   * @return Response PSR-7 response object.
   */
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

  /**
   * Update an existing product.
   *
   * @param Request $request PSR-7 request object.
   * @param Response $response PSR-7 response object.
   * @param array $args Route parameters.
   * @return Response PSR-7 response object.
   */
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

  /**
   * Delete a product.
   *
   * @param Request $request PSR-7 request object.
   * @param Response $response PSR-7 response object.
   * @param array $args Route parameters.
   * @return Response PSR-7 response object.
   */
  public function deleteProduct(Request $request, Response $response, $args): Response {
    $productToDelete = $args['code'];
    $payload = $this->productsService->deleteProduct($productToDelete);
    $response->getBody()->write(json_encode($payload));

    return $response->withHeader('Content-Type', 'application/json');
  }


  /**
   * Get a specified number of special offer products.
   *
   * @param Request $request PSR-7 request object.
   * @param Response $response PSR-7 response object.
   * @return Response PSR-7 response object.
   */
  public function getSpecialOffers(Request $request, Response $response): Response {
    $payload = $this->productsService->getSpecialOffers();
    $response->getBody()->write(json_encode($payload));
    return $response->withHeader('Content-Type', 'application/json');
  }

   /**
   * Get a specified number of new arrival products.
   *
   * @param Request $request PSR-7 request object.
   * @param Response $response PSR-7 response object.
   * @return Response PSR-7 response object.
   */
  public function getNewArrivals(Request $request, Response $response): Response {
    $payload = $this->productsService->getNewArrivals();
    $response->getBody()->write(json_encode($payload));
    return $response->withHeader('Content-Type', 'application/json');
  }

  /**
   * Get all featured products.
   *
   * @param Request $request PSR-7 request object.
   * @param Response $response PSR-7 response object.
   * @return Response PSR-7 response object.
   */
  public function getFeaturedProducts(Request $request, Response $response): Response {
    $payload = $this->productsService->getFeaturedProducts();
    $response->getBody()->write(json_encode($payload));
    return $response->withHeader('Content-Type', 'application/json');
  }
}


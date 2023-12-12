<?php
namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\System\DB;

class HomeController implements ControllerInterface {
  private $db;

  public function __construct(DB $db)
  {
    $this->db = $db;
  }

  public function index(Request $request, Response $response, $args): Response {
    $queryBuilder = $this->db->getQueryBuilder();
    $queryBuilder->select('count(*) as count')->from('employees');

    $payload = [
      'employees' => $queryBuilder->executeQuery()->fetchAll(),
    ];

    $response->getBody()->write(json_encode($payload));
    return $response->withHeader('Content-Type', 'application/json');
  }
}

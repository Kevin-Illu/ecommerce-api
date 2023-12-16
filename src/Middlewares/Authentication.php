<?php
namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as Response;

use App\System\DB;

class Authentication {
  private DB $db;

  public function __construct(DB $db) {
    $this->db = $db;
  }

  public function verifyApiKey (Request $request, RequestHandler $handler) {
    $userName = $request->getHeaderLine('X-API-User');
    $apiKey = $request->getHeaderLine('X-API-Key');

    if(!$userName || !$apiKey) {
      return $this->sendErrorResponse(['msg' => 'Specify UserName and ApiKey for authentication']);
    }

    $queryBuilder = $this->db->getQueryBuilder();
    $queryBuilder
    ->select('apiKey')
    ->from('users')
    ->where('userName = ?')
    ->setParameter(0, $userName);

    $result = $queryBuilder->executeQuery()->fetchAssociative();


    if(!$result) {
      return $this->sendErrorResponse(['msg' => 'UserName does not exist']);
    }

    if(array_key_exists('apiKey', $result)) {
      $hashedApiKey = $result['apiKey'];
    } else {
      return $this->sendErrorResponse(['msg' => 'userName does not exist']);
    }

    if(!password_verify($apiKey, $hashedApiKey)) {
      return $this->sendErrorResponse([
        'msg' => 'Invalid Api Key',
      ]);
    }

    $response = $handler->handle($request);
    return $response;
  }

  private function sendErrorResponse ($error): Response {
    $response = new Response();
    $response->getBody()->write(json_encode($error));
    $newResponse = $response->withStatus(401);
    return $newResponse;
  }
}

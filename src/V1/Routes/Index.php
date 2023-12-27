<?php
namespace App\V1\Routes;
namespace App\Controllers;

require_once __DIR__ . '/../../../public/index.php';
require_once __DIR__ . '/../../Middlewares/SchemaValidator/AuthDataValidator.php';

$app->get('/', 'App\Controllers\HomeController:index');

$app->get('/auth', AuthController::class . ':index')
  ->add($validateAuthSchema);



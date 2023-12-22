<?php
namespace App\V1\Routes;
namespace App\Controllers;

require_once __DIR__ . '/../../../public/index.php';
require_once __DIR__ . '/../../Middlewares/AuthValidatorSchema.php';

$app->get('/api/v1/', 'App\Controllers\HomeController:index');

$app->get('/api/v1/auth', AuthController::class . ':index')
  ->add($validateAuthSchema);



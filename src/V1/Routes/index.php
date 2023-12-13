<?php
namespace App\V1\Routes;

require_once __DIR__ . '/../../../public/index.php';

$app->get('/api/v1/', 'App\Controllers\HomeController:index');




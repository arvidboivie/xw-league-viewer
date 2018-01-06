<?php

require '../vendor/autoload.php';

use Noodlehaus\Config;

$config = Config::load('../config.yml');

$app = new \Slim\App(['settings' => $config]);

$container = $app->getContainer();
$container['logger'] = function ($c) {
    $logger = new \Monolog\Logger('logger');
    $file_handler = new \Monolog\Handler\StreamHandler('../logs/app.log');
    $logger->pushHandler($file_handler);

    return $logger;
};

// TODO: Add routes
// $app->get('/results', ResultsControllerController::class.':get');

$app->run();

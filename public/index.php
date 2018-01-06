<?php

require '../vendor/autoload.php';

use Boivie\League\Controller\ResultsController;
use Noodlehaus\Config;

$config = Config::load('../config.yml');

$app = new \Slim\App(['settings' => $config->all()]);

$container = $app->getContainer();
$container['logger'] = function ($c) {
    $logger = new \Monolog\Logger('logger');
    $file_handler = new \Monolog\Handler\StreamHandler('../logs/app.log');
    $logger->pushHandler($file_handler);

    return $logger;
};

// TODO: Add routes
$app->get('/results', ResultsController::class.':get');

$app->run();

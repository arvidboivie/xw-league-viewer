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

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('../templates', [
        'cache' => '../cache',
        'debug' => $container->get('settings')['twig_debug'],
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    $view->addExtension(new \Twig_Extension_Debug());

    return $view;
};

// TODO: Add routes
$app->get('/results/{year}/{league_number}', ResultsController::class.':get');

$app->run();

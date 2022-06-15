<?php

declare(strict_types=1);

session_start();

use App\Decorators\Decorator;
use App\Listeners\AdminListener;
use App\Listeners\AuthenticateListener;
use App\Listeners\ContentListener;
use App\Observers\EventManager;

spl_autoload_register(function ($fqcn) {
    $path = str_replace('\\', '/', $fqcn);
    require_once(__DIR__ . '/../' . $path . '.php');
});

define('APP_ENV', 'dev');

$router = App\Routing\Router::getFromGlobals();

$observer = new EventManager();

$adminListener = new AdminListener();
$authenticateListener = new AuthenticateListener();

$observer->subcribe($adminListener);
$observer->subcribe($authenticateListener);

$observer->notify('AuthenticateListener', $router);
$observer->notify('AdminListener', $router);

$controller = $router->getController();

$contentListener = new ContentListener();
$observer->subcribe($contentListener);
$controller = $observer->notify('ContentListener', $controller);
$controller->render();

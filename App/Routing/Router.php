<?php

declare(strict_types=1);

namespace App\Routing;

use App\Controller\Admin;
use App\Controller\Controller;
use App\Controller\Wordle;
use App\Controller\Error404;
use App\Controller\Login;
use App\Controller\Logout;
use App\Controller\Toto;
use App\Controller\Welcome;
use App\Controller\NewPlayer;
use App\Controller\Win;
use App\Controller\Fail;

class Router
{
    private array $routes = [
        '/' => Welcome::class,
        '/bidule' => Toto::class,
        '/404' => Error404::class,
        '/wordle' => Wordle::class,
        '/players/add' => NewPlayer::class,
        '/login' => Login::class,
        '/logout' => Logout::class,
        '/admin' => Admin::class,
        '/win' => Win::class,
        '/fail' => Fail::class
    ];

    private static string $path;

    private static ?Router $router = null;

    private function __construct()
    {
        self::$path = $_SERVER['PATH_INFO'] ?? '/';
    }

    public static function getFromGlobals(): Router
    {
        if (self::$router === null) {
            self::$router = new self();
        }

        return self::$router;
    }

    public function getController()
    {
        $controllerClass = $this->routes[self::$path] ?? $this->routes['/404'];
        $controller = new $controllerClass();

        if (!$controller instanceof Controller) {
            throw new \LogicException("controller $controllerClass should implement " . Controller::class);
        }

        return $controller;
    }

    public function getPath()
    {
        return self::$path;
    }
}

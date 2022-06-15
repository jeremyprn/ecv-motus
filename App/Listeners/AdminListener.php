<?php

declare(strict_types=1);

namespace App\Listeners;

class AdminListener
{
    private $name = "AdminListener";
    private $protectedRoutes = [
        '/admin'
    ];

    public function getName()
    {
        return $this->name;
    }

    public function update($router)
    {
        if (empty($_SESSION['admin']) &&  in_array($router->getPath(), $this->protectedRoutes))
            header('location: /login');
    }
}

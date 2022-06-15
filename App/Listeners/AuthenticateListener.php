<?php

declare(strict_types=1);

namespace App\Listeners;

class AuthenticateListener
{

    private $name = "AuthenticateListener";
    private $protectedRoutes = [
        '/bidule'
    ];

    public function getName()
    {
        return $this->name;
    }

    public function update($router)
    {
        if (empty($_SESSION['username']) &&  in_array($router->getPath(), $this->protectedRoutes))
            header('location: /login');
    }
}

<?php

namespace App\Decorators;

use App\Controller\Controller;

class Decorator implements Controller
{
    public $controller;

    public function render()
    {
        ob_start();
        $this->controller->render();
        $content = ob_get_clean();
        echo $content;
    }

    public function decorate($controller)
    {
        $this->controller = $controller;
        return $this;
    }
}

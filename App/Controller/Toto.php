<?php

declare(strict_types=1);

namespace App\Controller;

class Toto implements Controller
{
    public function render()
    {
        echo 'Page de test';
    }
}

<?php

declare(strict_types=1);

namespace App\Controller;

class Admin implements Controller
{
    public function render()
    {
        echo "
            Connecté en tant qu'administrateur
        ";
    }
}

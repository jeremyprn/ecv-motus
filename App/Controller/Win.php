<?php

namespace App\Controller;

class Win implements Controller
{
    public function render()
    {
        setcookie("wordToFind", "");
        setcookie("lines", "0");
        echo "Félicitations";
        echo '<a href="/">Nouvelle partie</a>';
    }
}
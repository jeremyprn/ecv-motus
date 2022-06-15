<?php

namespace App\Controller;

class Fail implements Controller
{
    public function render()
    {
        setcookie("wordToFind", "");
        setcookie("lines", "0");
        echo '<a href="/">Rejouer</a>';
    }
}
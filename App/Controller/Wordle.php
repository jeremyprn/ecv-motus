<?php

declare(strict_types=1);

namespace App\Controller;

use App\Wordle\Game;

class Wordle implements Controller
{
    public function render()
    {
        $wordle = new Game;
        
        echo '
        <form method="post">
            <input type="text" name="wordSuggestion" />
        </form>
        ';
       
    }
}

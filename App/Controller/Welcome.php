<?php

declare(strict_types=1);

namespace App\Controller;

use App\Decorators\Decorator;
use App\Wordle\Game;

class Welcome extends Decorator
{
    public function render()
    {
        $game = new Game;

        if (null === $wordToFind = $_COOKIE['wordToFind']) {
            setcookie('wordToFind', $game->getRandomWord());
            setcookie('lines', '0');
        }
        
        if($_COOKIE['wordToFind']){
            $game->setWordToFind($_COOKIE['wordToFind']);
            $game->setLines(intval($_COOKIE['lines']));
        }
        
        if ($game->getLines() >= 6) {
            echo "Perdu";
            setcookie('wordToFind', "");
        }

        $word = htmlspecialchars($_COOKIE["wordToFind"]);
        $splitWord = str_split($word);
        $length = strlen($word);
        
        if ( isset( $_GET['wordSuggestion'] ) ) {
            $search = strtolower($_GET['wordSuggestion']);
            $splitSearch = str_split($search);
            setcookie('lines', strval($_COOKIE["lines"] + 1));
            echo "Tentative(s) restante(s) " . 5 - $_COOKIE["lines"];
            
            echo '<div style="display: flex; gap: 10px;">';
            if($length !== strlen($search)) {
                echo '<br>Veuillez entrer un mot en ' . $length . " lettres.";
            } elseif ($_COOKIE["lines"] < 5) {
                if($search == $word) {
                header('Location: /win');
                }
                else {
                    for ($i = 0; $i < $length; $i++) {
                        if($splitSearch[$i] == $splitWord[$i]) {
                            echo '<span style="background-color:"blue">' . $splitSearch[$i] . '</span>';
                        } else if (in_array($splitSearch[$i], $splitWord)) {
                            echo '<span style="background-color:yellow">' . $splitSearch[$i] . '</span>';
                        } else {
                            echo '<span style="background-color:red">' . $splitSearch[$i] . '</span>';
                        }
                    }
                }
            }
            else {
                setcookie("lines", "0");
                header('Location: /fail');
            }
            echo '</div>';

        }
        require_once(__DIR__ . '/../../Templates/Wordle.html');
        
    }

    
}

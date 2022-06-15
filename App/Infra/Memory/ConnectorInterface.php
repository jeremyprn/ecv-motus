<?php

declare(strict_types=1);

namespace App\Infra\Memory;

use App\Wordle\WordToFind;

interface ConnectorInterface
{
    public static function addWord(WordToFind $word);

    public static function randomWord(): WordToFind;
}

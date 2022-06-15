<?php

declare(strict_types=1);

namespace App\Wordle;

class WordToFind
{
    public function __construct(public ?string $word = "")
    {
    }

    public function getWordToFind() : string{
        
        return $this->word;
    }
}
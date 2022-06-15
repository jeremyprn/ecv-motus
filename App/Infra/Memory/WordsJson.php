<?php

declare(strict_types=1);

namespace App\Infra\Memory;

use App\Wordle\WordToFind;

class WordsJson implements ConnectorInterface
{
    private const FILE_PATH = __DIR__ . '/../../../var/words.txt';
    private static array $words = [];

    private static function loadFile()
    {
        if (empty(self::$words)) {
            $contents = file_get_contents(self::FILE_PATH);
            self::$words =explode("\n",$contents);
        }
        
        return self::$words;
    }

    public static function addWord(WordToFind $word)
    {
        self::loadFile();
        self::$words[] = $word;

        file_put_contents(self::FILE_PATH, json_encode(self::$words));
    }

    public static function randomWord(): WordToFind
    {
        self::loadFile();

        // $words = array_filter(self::$words, function($word){
        //     // return $player['name'] === $name;
        //     return $word;
        // });
        
        $word = self::$words[rand(0, count(self::$words)-1)];

        // $word= reset($words);
        return new WordToFind($word);
    }
}

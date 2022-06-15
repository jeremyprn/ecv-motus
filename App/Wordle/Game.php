<?php

declare(strict_types=1);

namespace App\Wordle;

use App\Infra\Memory\DbSelector;

class Game {

    private $lines = 0;
    private $wordToFind = "";
    private $randomWord = "";
    private $wordSuggestion = [];
    private $wordPlacement = [];

    public function __construct()
    {
        try {
            $randomWord = DbSelector::getConnector()::randomWord();
            $this->randomWord = $randomWord->word;
        } catch (\RuntimeException $e) {
            echo $e->getMessage();
            return;
        }
    }

    public function addLine() {
        $this->lines += 1;

        return $this;
    }
    public function setLines(int $lines){
        $this->lines = $lines;
        return $this;
    }
    public function getLines(): int{
        return $this->lines;
    }
    public function setWordToFind(string $wordToFind){
        $this->wordToFind = $wordToFind;
        return $this;
    }
    public function getWordToFind(): string{
        return $this->wordToFind;
    }
    public function setRandomWord(string $randomWord){
        $this->randomWord = $randomWord;
        return $this;
    }
    public function getRandomWord(): string{
        return $this->randomWord;
    }
    public function setWordSuggestion(array $wordSuggestion){
        $this->wordSuggestion = $wordSuggestion;
        return $this;
    }
    public function getWordSuggestion(): array{
        return $this->wordSuggestion;
    }
    public function setWordPlacement(int $position, string $letter, string $placement){
        foreach ($this->wordPlacement !== null as $value) {
            if($value->position !== $position){
                array_push($this->wordPlacement, (object)[
                    'position' => $position,
                    'letter' => $letter,
                    'placement' => $placement ]);
            }
            print_r($this->wordPlacement);
        }
        return $this;
    }
    public function getWordPlacement(): array{
        return $this->wordPlacement;
    }

    public function checkWord(){

        $wordToFind = str_split(strtolower($this->wordToFind));
        $wordSuggestion = $this->wordSuggestion;

        for ($i = 0; $i < count($wordToFind); $i++){
            if($wordToFind[$i] == $wordSuggestion[$i]){
                $this->setWordPlacement($i, $wordSuggestion[$i], "good");
            }

            for ($k = 0; $k < count($wordSuggestion); $k++){
                if($wordToFind[$k] == $wordSuggestion[$i]){
                    $this->setWordPlacement($i, $wordSuggestion[$i], "missplaced");
                }
            }
            
        }
    }
    
}
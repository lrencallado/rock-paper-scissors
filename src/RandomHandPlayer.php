<?php

namespace RockPaperScissorsShoot;

class RandomHandPlayer extends Player
{
    private array $choices;

    public function __construct(string $name, array $choices)
    {
        parent::__construct($name);

        $this->choices = $choices;
    }

    public function setRandomChoice(): void
    {
        $this->choice = $this->choices[array_rand($this->choices)];
    }
}
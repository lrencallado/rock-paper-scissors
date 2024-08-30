<?php

namespace RockPaperScissorsShoot;

class RandomHandPlayer extends Player
{
    protected array $choices;

    public function __construct(string $name, array $choices)
    {
        parent::__construct($name);
        $this->choices = $choices;
    }

    public function getChoice(): string
    {
        return $this->choices[array_rand($this->choices)];
    }
}
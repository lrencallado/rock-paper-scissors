<?php

namespace RockPaperScissorsShoot;

class FixedHandPlayer extends Player
{
    public function __construct(string $name, string $fixedChoice)
    {
        parent::__construct($name);
        $this->choice = $fixedChoice;
    }
}
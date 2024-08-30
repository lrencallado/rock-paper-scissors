<?php

namespace RockPaperScissorsShoot;

class Player
{
    protected string $name;
    protected string $choice;

    public function __construct(string $name)
    {        
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getChoice(): string
    {
        return $this->choice;
    }

    public function setChoice(string $choice): void
    {
        $this->choice = $choice;
    }
}
<?php

namespace RockPaperScissorsShoot;

use RuntimeException;

class Game
{
    private Player $player1;
    private Player $player2;
    private array $rules;
    private int $rounds;

    private int $player1Wins = 0;
    private int $player2Wins = 0;
    private int $draws = 0;
    
    public function __construct(Player $player1, Player $player2, array $rules, int $rounds = 100)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
        $this->rules = $rules;
        $this->rounds = $rounds;
    }

    public function play()
    {
        for ($i = 0; $i < $this->rounds; $i++) {
            $this->player2->setRandomChoice(); // Player 2 makes a random choice

            if (!$this->player1->getChoice() || !$this->player2->getChoice()) {
                throw new RuntimeException('Both players must make a choice before playing a round.');
            }

            $result = $this->getRoundResult();

            if ($result === 1) {
                $this->player1Wins++;
            } elseif ($result === 2) {
                $this->player2Wins++;
            } else {
                $this->draws++;
            }
        }
    }

    private function getRoundResult(): int
    {
        $choice1 = $this->player1->getChoice();
        $choice2 = $this->player2->getChoice();

        // Return the result based on the rules
        return $this->rules[$choice1][$choice2];
    }

    public function showStatistics(): void
    {
        echo "{$this->player1->getName()} Wins: {$this->player1Wins}\n";
        echo "{$this->player2->getName()} Wins: {$this->player2Wins}\n";
        echo "Draws: {$this->draws}\n";
    }
}
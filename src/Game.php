<?php

namespace RockPaperScissorsShoot;

class Game
{
    private Player $player1;
    private Player $player2;
    private Rule $rule;
    private int $rounds;

    private int $player1Wins = 0;
    private int $player2Wins = 0;
    private int $draws = 0;
    
    public function __construct(Player $player1, Player $player2, Rule $rule, int $rounds = 100)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
        $this->rule = $rule;
        $this->rounds = $rounds;
    }

    public function play(): void
    {
        for ($i = 0; $i < $this->rounds; $i++) {
            $this->playRound();
        }
    }

    private function playRound(): void
    {
        $choice1 = $this->player1->getChoice();
        $choice2 = $this->player2->getChoice();

        $result = $this->rule->determineOutcome($choice1, $choice2);

        if ($result === 1) {
            $this->player1Wins++;
        } elseif ($result === 2) {
            $this->player2Wins++;
        } else {
            $this->draws++;
        }
    }

    public function showStatistics(): void
    {
        echo "{$this->player1->getName()} Wins: {$this->player1Wins}\n";
        echo "{$this->player2->getName()} Wins: {$this->player2Wins}\n";
        echo "Draws: {$this->draws}\n";
    }
}
<?php

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

class FixedChoicePlayer extends Player
{
    public function __construct(string $name, string $fixedChoice)
    {
        parent::__construct($name);
        $this->choice = $fixedChoice;
    }
}

class RandomChoicePlayer extends Player
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

    public function play(): void
    {
        for ($i = 0; $i < $this->rounds; $i++) {
            $this->player2->setRandomChoice(); // Player 2 makes a random choice

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

        if ($choice1 === $choice2) {
            return 0; // Draw
        }

        return $this->rules[$choice1] === $choice2 ? 1 : 2;
    }

    public function showStatistics(): void
    {
        echo "{$this->player1->getName()} Wins: {$this->player1Wins}\n";
        echo "{$this->player2->getName()} Wins: {$this->player2Wins}\n";
        echo "Draws: {$this->draws}\n";
    }
}

// Define rules
$rules = [
    'rock' => 'scissors',
    'scissors' => 'paper',
    'paper' => 'rock'
];

// Initialize players
$player1 = new FixedChoicePlayer("Player 1", 'rock');
$player2 = new RandomChoicePlayer("Player 2", array_keys($rules));

// Play the game
$game = new Game($player1, $player2, $rules);
$game->play();
$game->showStatistics();


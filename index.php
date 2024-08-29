<?php

class Player
{
    protected string $name;
    protected string $choice;

    public function __construct(string $name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException('Player name cannot be empty.');
        }
        
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
        if (empty($choice)) {
            throw new InvalidArgumentException('Choice cannot be empty.');
        }

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

        if (empty($choices)) {
            throw new InvalidArgumentException('Choices array cannot be empty.');
        }

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
    private array $errors = [];
    
    public function __construct(Player $player1, Player $player2, array $rules, int $rounds = 100)
    {
        if (is_null($player1) || is_null($player2)) {
            throw new InvalidArgumentException('Both players must be initialized.');
        }

        if (empty($rules)) {
            throw new InvalidArgumentException('Rules cannot be empty.');
        }

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

    private function errors(): bool
    {
        return count($this->errors) > 0;
    }
}

/**
 * 0 if Draw
 * 1 if Player 1 wins
 * 2 if Player 2 wins
 */
$rules = [
    'rock' => ['rock' => 0, 'scissors' => 1, 'paper' => 2],
    'scissors' => ['scissors' => 0, 'paper' => 1, 'rock' => 2],
    'paper' => ['paper' => 0, 'rock' => 1, 'scissors' => 2],
];

// Initialize players
$player1 = new FixedChoicePlayer('Player 1', 'rock');
$player2 = new RandomChoicePlayer('Player 2', array_keys($rules));

// Play the game
$game = new Game($player1, $player2, $rules);
$game->play();
$game->showStatistics();


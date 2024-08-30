<?php

namespace RockPaperScissorsShoot;

class Rule
{
    private array $outcomeTable = [];

    public function __construct()
    {
        // Initialize default rules
        $this->setDefaultRules();
    }

    /**
     * Initialized the default rules
     */
    public function setDefaultRules(): void
    {
        // Rock-Paper-Scissors defaults
        $this->addRule('rock', 'scissors', 1); // Rock beats Scissors
        $this->addRule('scissors', 'paper', 1); // Scissors beat Paper
        $this->addRule('paper', 'rock', 1); // Paper beats Rock

        // Inverse rules
        $this->addRule('scissors', 'rock', 2); // Scissors lose to Rock
        $this->addRule('paper', 'scissors', 2); // Paper loses to Scissors
        $this->addRule('rock', 'paper', 2); // Rock loses to Paper

        // Draw rules
        $this->addRule('rock', 'rock', 0); // Rock equals Rock
        $this->addRule('scissors', 'scissors', 0); // Scissors equal Scissors
        $this->addRule('paper', 'paper', 0); // Paper equals Paper
    }

    /**
     * Adds a rule to the outcome table.
     *
     * @param string $choice1 The first choice (e.g., "rock").
     * @param string $choice2 The second choice (e.g., "scissors").
     * @param int $outcome The outcome of the comparison: 1 if $choice1 wins, 2 if $choice2 wins, 0 for a draw.
     */
    public function addRule(string $choice1, string $choice2, int $outcome): void
    {
        if (!in_array($outcome, [0, 1, 2])) {
            throw new \InvalidArgumentException("Invalid outcome value. Must be 0, 1, or 2.");
        }

        if (empty($choice1) || empty($choice2)) {
            throw new \InvalidArgumentException("Choices cannot be empty.");
        }

        $this->outcomeTable[$choice1][$choice2] = $outcome;
    }

     /**
     * Determines the outcome of a round based on the two choices.
     *
     * @param string $choice1 The first player's choice.
     * @param string $choice2 The second player's choice.
     * @return int The result of the round: 1 if $choice1 wins, 2 if $choice2 wins, 0 for a draw.
     */
    public function determineOutcome(string $choice1, string $choice2): int
    {
        if (!isset($this->outcomeTable[$choice1])) {
            throw new \InvalidArgumentException("Invalid choice: $choice1");
        }

        if (!isset($this->outcomeTable[$choice1][$choice2])) {
            throw new \InvalidArgumentException("Invalid choice: $choice2");
        }

        return $this->outcomeTable[$choice1][$choice2];
    }
}
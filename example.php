<?php

require 'autoload.php';

use RockPaperScissorsShoot\FixedHandPlayer;
use RockPaperScissorsShoot\Game;
use RockPaperScissorsShoot\RandomHandPlayer;
use RockPaperScissorsShoot\Rule;

$rule = new Rule();

// Example of adding new rules for "Lizard" and "Spock"
$rule->addRule('rock', 'lizard', 1); // Rock beats Lizard
$rule->addRule('lizard', 'Spock', 1); // Lizard beats Spock

// Initialize players
$player1 = new FixedHandPlayer('Player 1', 'rocks');

$player2 = new RandomHandPlayer('Player 2', ['rock', 'paper', 'scissors']);

// Play the game
$game = new Game($player1, $player2, $rule);
$game->play();
$game->showStatistics();


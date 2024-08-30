<?php

require 'autoload.php';

use RockPaperScissorsShoot\FixedHandPlayer;
use RockPaperScissorsShoot\Game;
use RockPaperScissorsShoot\RandomHandPlayer;

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
$player1 = new FixedHandPlayer('Player 1', 'rock');
$player2 = new RandomHandPlayer('Player 2', array_keys($rules));

// Play the game
$game = new Game($player1, $player2, $rules);
$game->play();
$game->showStatistics();


<?php

namespace Boivie\League\Scoreboard;

class Player
{
    protected $name;

    protected $gamesPlayed;

    protected $gamesWon;

    protected $marginOfVictory;

    public function __construct($name)
    {
        $this->name = $name;
        $this->gamesPlayed = 0;
        $this->marginOfVictory = 0;
    }

    public function getGamesPlayed()
    {
        return $this->gamesPlayed;
    }

    public function getGamesWon()
    {
        return $this->gamesWon;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getScore()
    {
        return $this->gamesPlayed + $this->gamesWon;
    }

    public function getMarginOfVictory()
    {
        return $this->marginOfVictory;
    }

    public function addGame()
    {
        ++$this->gamesPlayed;
    }

    public function addWin()
    {
        ++$this->gamesWon;
    }

    public function addMarginOfVictory($marginOfVictory)
    {
        $this->marginOfVictory += $marginOfVictory;
    }
}

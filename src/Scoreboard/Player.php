<?php

namespace Boivie\League\Scoreboard;

class Player
{
    protected $gamesPlayed;

    protected $name;

    protected $score;

    public function __construct($name)
    {
        $this->name = $name;
        $this->score = 0;
        $this->gamesPlayed = 0;
    }

    public function getGamesPlayed()
    {
        return $this->gamesPlayed;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getScore()
    {
        return $this->score;
    }

    public function addGame()
    {
        ++$this->gamesPlayed;
    }

    public function addPoint()
    {
        ++$this->score;
    }
}

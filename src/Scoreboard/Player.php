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

    public function addPoint()
    {
        ++$this->score;
    }
}

<?php

namespace Boivie\League\Game;

use Boivie\League\Result;

class Player
{
    protected $name;

    protected $list;

    protected $pointsDestroyed;

    protected $pointsLost;

    protected $winner;

    public function __construct(Result $result)
    {
        $this->name = $result->getReporterName();
        $this->list = $result->getListUrl();
        $this->pointsDestroyed = $result->getPointsDestroyed();
        $this->pointsLost = $result->getPointsLost();
        $this->winner = $result->getResult() === Result::WIN ? true : false;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getList()
    {
        return $this->list;
    }

    public function getPointsDestroyed()
    {
        return $this->pointsDestroyed;
    }

    public function getPointsLost()
    {
        return $this->pointsLost;
    }

    public function isWinner()
    {
        return $this->winner;
    }
}

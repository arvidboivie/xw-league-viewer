<?php

namespace Boivie\League\Game;

use Boivie\League\Result;

class Game
{
    protected $players;

    protected $datePlayed;

    public function __construct(Result $resultOne, Result $resultTwo)
    {
        if ($resultOne->getResult() === Result::WIN) {
            $this->players = [
                new Player($resultOne),
                new Player($resultTwo),
            ];
        } else {
            $this->players = [
                new Player($resultTwo),
                new Player($resultOne),
            ];
        }

        $this->datePlayed = $resultOne->getDatePlayed();
    }

    public function getDatePlayed()
    {
        return $this->datePlayed;
    }

    public function getLoser()
    {
        return $this->players[1];
    }

    public function getPlayers()
    {
        return $this->players;
    }

    public function getWinner()
    {
        return $this->players[0];
    }

    public function matchesResult(Result $result)
    {
        return
            $this->datePlayed === $result->getDatePlayed() &&
            (
                $this->players[0]->getName() === $result->getReporterName() &&
                $this->players[1]->getName() === $result->getOpponentName()
            ) || (
                $this->players[0]->getName() === $result->getOpponentName() &&
                $this->players[1]->getName() === $result->getReporterName()
            )
        ;
    }
}

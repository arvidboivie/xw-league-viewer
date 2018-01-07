<?php

namespace Boivie\League\Game;

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
                $this->players[0]->name === $result->getReporterName() &&
                $this->players[1]->name === $result->getOpponentName()
            ) || (
                $this->players[0]->name === $result->getOpponentName() &&
                $this->players[1]->name === $result->getReporterName()
            )
        ;
    }
}

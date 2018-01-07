<?php

namespace Boivie\League\Scoreboard;

class Scoreboard
{
    protected $players;

    public function addGames($games)
    {
        foreach ($games as $game) {
            $players = $game->getPlayers();

            foreach ($players as $player) {
                $scoreboardPlayer = $this->getExistingPlayer($player);

                if (isset($scoreboardPlayer) === false) {
                    $scoreboardPlayer = new Player($player->getName());
                    $this->players[] = $scoreboardPlayer;
                }

                if ($player->isWinner()) {
                    $scoreboardPlayer->addPoint();
                }

                $scoreboardPlayer->addGame();
                $scoreboardPlayer->addPoint(); // Playing a game gets you a point
            }
        }
    }

    public function getScoreboard()
    {
        usort($this->players, [$this, 'compareScore']);

        return $this->players;
    }

    private function compareScore($playerA, $playerB)
    {
        if ($playerA->getScore() === $playerB->getScore()) {
            if ($playerA->getGamesPlayed() === $playerB->getGamesPlayed()) {
                return 0;
            }

            return ($playerA->getScore() < $playerB->getScore()) ? 1 : -1;
        }

        return ($playerA->getScore() < $playerB->getScore()) ? -1 : 1;
    }

    private function getExistingPlayer($player)
    {
        foreach ($this->players as $existingPlayer) {
            if ($player->getName() === $existingPlayer->getName()) {
                return $existingPlayer;
            }
        }
    }
}

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
                    $scoreboardPlayer->addWin();
                }

                $scoreboardPlayer->addGame();
                $scoreboardPlayer->addMarginOfVictory(
                    $this->calculateMarginOfVictory(
                        $player,
                        $player->isWinner()
                    )
                );
            }
        }
    }

    public function getScoreboard()
    {
        usort($this->players, [$this, 'compareScore']);

        return $this->players;
    }

    private function calculateMarginOfVictory($player, $isWinner)
    {
        $pointsDifference = abs($player->getPointsDestroyed() - $player->getPointsLost());

        if ($isWinner === true) {
            return 100 + $pointsDifference;
        }

        return 100 - $pointsDifference;
    }

    private function compareScore(Player $a, Player $b)
    {
        // Reminder: Returning 1 puts players further down on the scoreboard, and vice versa

        if ($a->getScore() === $b->getScore()) {
            if ($a->getGamesPlayed() === $b->getGamesPlayed()) {
                if ($a->getMarginOfVictory() === $b->getMarginOfVictory()) {
                    return 0;
                }

                // If players have the same score and the same number of games played,
                // break the tie on MoV
                return ($a->getMarginOfVictory() < $b->getMarginOfVictory()) ? 1 : -1;
            }

            // If players have the same score, the one with fewer games is in the lead
            return ($a->getGamesPlayed() > $b->getGamesPlayed()) ? 1 : -1;
        }

        // If players don't have the same score, the one with the higher score is in the lead
        return ($a->getScore() < $b->getScore()) ? 1 : -1;
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

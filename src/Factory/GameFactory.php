<?php

namespace Boivie\League\Factory;

use Boivie\League\Game\Game;

class GameFactory
{
    public static function createGamesFromResults($results)
    {
        $games = [];

        foreach ($results as $resultOne) {
            foreach ($games as $game) {
                if ($game->matchesResult($resultOne)) {
                    continue 2; // Continue the outer foreach
                }
            }
            foreach ($results as $resultTwo) {
                if ($resultOne->matches($resultTwo)) {
                    $games[] = new Game($resultOne, $resultTwo);
                    continue 2;
                }
            }
        }

        return $games;
    }
}

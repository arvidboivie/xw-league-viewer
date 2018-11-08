<?php

namespace Boivie\League\Controller;

use Boivie\League\Factory\GameFactory;
use Boivie\League\Result;
use Boivie\League\Scoreboard\Scoreboard;

class ResultsController extends BaseController
{
    public function get($request, $response, $args)
    {
        $client = new \Google_Client();
        $client->setApplicationName('xw-league-viewer');
        $client->setDeveloperKey($this->container->get('settings')['google_api_key']);

        $sheetService = new \Google_Service_Sheets($client);

        $year = $args['year'];
        $league = $args['league_number'];
        $league_info = $this->container->get('settings')['leagues'][$year][$league];
        $edition = $this->container->get('settings')['leagues'][$year][$league];
        $spreadsheetId = $league_info['sheet_id'];

        $sheetName = 'Form Responses 1';
        $range = $sheetName.'!A2:H1000';

        $sheetResponse = $sheetService->spreadsheets_values->get(
            $spreadsheetId,
            $range,
            ['majorDimension' => 'rows']
        );

        $values = $sheetResponse->getValues();

        $results = [];

        foreach ($values as $value) {
            $results[] = new Result($value);
        }

        $games = GameFactory::createGamesFromResults($results);

        usort($games, [$this, 'sortGamesByDate']);

        $scoreboard = new Scoreboard($edition);

        $scoreboard->addGames($games);

        return $this->container['view']->render(
            $response,
            'results.html',
            [
                'league_info' => $league_info,
                'games' => $games,
                'scoreboard' => $scoreboard->getScoreboard(),
            ]
        );
    }

    private function sortGamesByDate($gameA, $gameB)
    {
        $dateA = $gameA->getDatePlayed();
        $dateB = $gameB->getDatePlayed();

        if ($dateA->eq($dateB)) {
            return 0;
        }

        return $dateA->gt($dateB) ? -1 : 1;
    }
}

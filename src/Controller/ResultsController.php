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
        $spreadsheetId = $this->container->get('settings')['sheets'][$year][$league];

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

        $games = $this->sortGamesByDate($games);

        $scoreboard = new Scoreboard();

        $scoreboard->addGames($games);

        return $this->container['view']->render(
            $response,
            'results.html',
            [
                'games' => $games,
                'scoreboard' => $scoreboard->getScoreboard(),
            ]
        );
    }

    private function sortGamesByDate($games)
    {
        // TODO: this will have to do until I implement Carbon and compare dates LOL
        return array_reverse($games);
    }
}

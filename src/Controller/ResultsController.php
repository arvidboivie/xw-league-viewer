<?php

namespace Boivie\League\Controller;

use Boivie\League\Games\Result;

class ResultsController extends BaseController
{
    public function get($request, $response, $args)
    {
        $client = new \Google_Client();
        $client->setApplicationName('xw-league-viewer');
        $client->setDeveloperKey('***REMOVED***');

        $sheetService = new \Google_Service_Sheets($client);

        $spreadsheetId = '***REMOVED***';

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

        return $this->container['view']->render(
            $response,
            'results.html',
            ['results' => $results]
        );
    }

    // private function combineResultsToGames($results)
    // {
    //     $games = [];
    //
    //     foreach ($results as $resultOne) {
    //         foreach ($results as $resultTwo) {
    //             if (compareResults($resultOne, $resultTwo) && )
    //         }
    //     }
    //
    //     return $games;
    // }
    //
    // private function compareResults($resultOne, $resultTwo)
    // {
    //     return
    //         $resultOne['reporter'] === $resultTwo['opponent']
    //         && $resultOne['date_played'] === $resultTwo['date_played'];
    // }
    //
    // private function alreadyCombined($games, $result) {
    //     foreach ($games as $game) {
    //         if ($game['date_played'] === $result['date_played']
    //             && $game['player_one'] === )
    //     }
    // }
}

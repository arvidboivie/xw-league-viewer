<?php

namespace Boivie\League\Controller;

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

        $sheetResponse = $sheetService->spreadsheets_values->get($spreadsheetId, $range, ['majorDimension' => 'rows']);

        $values = $sheetResponse->getValues();

        $arrayFields =
        [
            'timestamp',
            'reporter',
            'opponent',
            'points_lost',
            'points_destroyed',
            'result',
            'date_played',
            'list_url',
        ];

        $namedValues = [];

        foreach ($values as $item) {
            foreach ($item as $key => $value) {
                $namedValues[$arrayFields[$key]] = $item[$key];
            }
        }

        $response->getBody()->write(print_r($namedValues), true);
    }
}

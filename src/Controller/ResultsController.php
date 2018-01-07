<?php

namespace Boivie\League\Controller;

class ResultsController extends BaseController
{
    protected $arrayFields =
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

        $results = $this->addHeadersToResults($values);

        return $this->container['view']->render(
            $response,
            'results.html',
            ['results' => $results]
        );
    }

    private function addHeadersToResults($results)
    {
        $namedResults = [];

        foreach ($results as $item) {
            $namedValues = [];

            foreach ($item as $key => $value) {
                $namedValues[$this->arrayFields[$key]] = $item[$key];
            }

            $namedResults[] = $namedValues;
        }

        return $namedResults;
    }
}

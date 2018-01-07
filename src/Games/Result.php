<?php

namespace Boivie\League\Games;

class Result
{
    const WIN = 'Vinst';
    const LOSS = 'Förlust';

    protected $properties =
        [
            'timestamp',
            'reporterName',
            'opponentName',
            'pointsLost',
            'pointsDestroyed',
            'result',
            'datePlayed',
            'listUrl',
        ];

    // These are public to allow twig access

    public $timestamp;

    public $reporterName;

    public $opponentName;

    public $pointsLost;

    public $pointsDestroyed;

    public $result;

    public $datePlayed;

    public $listUrl;

    public function __construct($result)
    {
        foreach ($result as $key => $value) {
            $keyName = $this->properties[$key];
            $this->$keyName = $value;
        }
    }
}

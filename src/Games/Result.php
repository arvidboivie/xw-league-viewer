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

    protected $timestamp;

    protected $reporterName;

    protected $opponentName;

    protected $pointsLost;

    protected $pointsDestroyed;

    protected $result;

    protected $datePlayed;

    protected $listUrl;

    public function __construct($result)
    {
        foreach ($result as $key => $value) {
            $keyName = $this->properties[$key];
            $this->$keyName = $value;
        }
    }
}

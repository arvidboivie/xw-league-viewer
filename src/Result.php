<?php

namespace Boivie\League;

use Carbon\Carbon;

class Result
{
    const WIN = 'Vinst';
    const LOSS = 'Förlust';

    protected $properties =
        [
            'timestamp',
            'reporterName',
            'opponentName',
            'pointsDestroyed',
            'pointsLost',
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

        $this->datePlayed = Carbon::createFromFormat('d/m/Y', $this->datePlayed);
    }

    public function getDatePlayed(): Carbon
    {
        return $this->datePlayed;
    }

    public function getListUrl()
    {
        return $this->listUrl;
    }

    public function getOpponentName()
    {
        return $this->opponentName;
    }

    public function getPointsDestroyed()
    {
        return $this->pointsDestroyed;
    }

    public function getPointsLost()
    {
        return $this->pointsLost;
    }

    public function getReporterName()
    {
        return $this->reporterName;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function matches(self $result)
    {
        return (
            $this->reporterName === $result->getOpponentName() &&
            $this->opponentName === $result->getReporterName() &&
            $this->datePlayed->eq($result->getDatePlayed()) &&
            $this->pointsLost === $result->getPointsDestroyed() &&
            $this->pointsDestroyed === $result->getPointsLost()
        ) && (
            ($this->result === self::WIN && $result->getResult() === self::LOSS) ||
            ($this->result === self::LOSS && $result->getResult() === self::WIN)
        );
    }
}

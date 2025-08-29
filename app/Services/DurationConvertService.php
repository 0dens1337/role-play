<?php

namespace App\Services;

use Carbon\CarbonInterval;
use DateTime;
use JetBrains\PhpStorm\NoReturn;

class DurationConvertService
{
    public static function durationHumanize(int $seconds): string
    {
        $interval = CarbonInterval::seconds($seconds)->cascade();

        $hours = floor($interval->totalSeconds / 3600);
        $minutes = floor(($interval->totalSeconds / 3600) / 60);

        return sprintf('%02d:%02d', $hours, $minutes);
    }
}

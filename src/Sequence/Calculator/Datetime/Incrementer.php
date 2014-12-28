<?php

namespace Ayaml\Sequence\Calculator\Datetime;

use Carbon\Carbon;

/**
 * Class Incrementer
 *
 * @package Ayaml\Sequence\Calculator\Datetime
 * @property \Carbon\Carbon end
 */
class Incrementer extends DatetimeCalculator implements DatetimeCalculatorInterface
{
    /**
     * @param string $overwriteVal
     * @return bool
     */
    public function isEnd($overwriteVal)
    {
        return Carbon::parse($overwriteVal)->gt($this->end);
    }

    public function byDay($format = null)
    {
        return $this->by(function ($originalDate) {
            return Carbon::parse($originalDate)->addDay()->toDateTimeString();
        }, $format);
    }

    public function byWeek($format = null)
    {
        return $this->by(function ($originalDate) {
            return Carbon::parse($originalDate)->addWeek()->toDateTimeString();
        }, $format);
    }

    public function byMonth($format = null)
    {
        return $this->by(function ($originalDate) {
            return Carbon::parse($originalDate)->addMonth()->toDateTimeString();
        }, $format);
    }

    public function byYear($format = null)
    {
        return $this->by(function ($originalDate) {
            return Carbon::parse($originalDate)->addYear()->toDateTimeString();
        }, $format);
    }
}

<?php

namespace Ayaml\Sequence\Calculator\Datetime;

use Carbon\Carbon;

/**
 * Class Incrementer
 *
 * @package Ayaml\Sequence\Calculator\Datetime
 * @property \Carbon\Carbon end
 */
class Decrementer extends DatetimeCalculator implements DatetimeCalculatorInterface
{
    /**
     * @param string $overwriteVal
     * @return bool
     */
    public function isEnd($overwriteVal)
    {
        return Carbon::parse($overwriteVal)->lt($this->end);
    }

    /**
     * @param null $format
     * @return \Ayaml\ContainerCollection
     */
    public function byDay($format = null)
    {
        return $this->by(function ($originalDate) {
            return Carbon::parse($originalDate)->subDay()->toDateTimeString();
        }, $format);
    }

    /**
     * @param null $format
     * @return \Ayaml\ContainerCollection
     */
    public function byWeek($format = null)
    {
        return $this->by(function ($originalDate) {
            return Carbon::parse($originalDate)->subWeek()->toDateTimeString();
        }, $format);
    }

    /**
     * @param null $format
     * @return \Ayaml\ContainerCollection
     */
    public function byMonth($format = null)
    {
        return $this->by(function ($originalDate) {
            return Carbon::parse($originalDate)->subMonth()->toDateTimeString();
        }, $format);
    }

    /**
     * @param null $format
     * @return \Ayaml\ContainerCollection
     */
    public function byYear($format = null)
    {
        return $this->by(function ($originalDate) {
            return Carbon::parse($originalDate)->subYear()->toDateTimeString();
        }, $format);
    }
}

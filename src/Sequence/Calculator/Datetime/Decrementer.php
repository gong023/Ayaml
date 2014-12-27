<?php

namespace Ayaml\Sequence\Calculator\Datetime;

use Ayaml\Sequence\Calculator;
use Carbon\Carbon;

/**
 * Class Incrementer
 *
 * @package Ayaml\Sequence\Calculator\Datetime
 * @property \Carbon\Carbon criteria
 * @property \Carbon\Carbon end
 */
class Decrementer extends Calculator implements DatetimeCalculatorInterface
{

    /**
     * @param string $overwriteVal
     * @return bool
     */
    function isEnd($overwriteVal)
    {
        return Carbon::parse($overwriteVal)->lte($this->end);
    }

    public function byDay($format = null)
    {
        return $this->by(function () use ($format) {
            $dayAgo = $this->criteria->copy()->subDay();

            if (! is_null($format)) {
                return $dayAgo->format($format);
            }

            return $dayAgo->toDateTimeString();
        });
    }

    public function byWeek($format = null)
    {
        return $this->by(function () use ($format) {
            $weekAgo = $this->criteria->copy()->subWeek();

            if (! is_null($format)) {
                return $weekAgo->format($format);
            }

            return $weekAgo->toDateTimeString();
        });
    }

    public function byMonth($format = null)
    {
        return $this->by(function () use ($format) {
            $monthAgo = $this->criteria->copy()->subMonth();

            if (! is_null($format)) {
                return $monthAgo->format($format);
            }

            return $monthAgo->toDateTimeString();
        });
    }

    public function byYear($format = null)
    {
        return $this->by(function () use ($format) {
            $yearAgo = $this->criteria->subYear();

            if (! is_null($format)) {
                return $yearAgo->format($format);
            }

            return $yearAgo->toDateTimeString();
        });
    }
}
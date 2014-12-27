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
class Incrementer extends Calculator implements DatetimeCalculatorInterface
{
    /**
     * @param string $overwriteVal
     * @return bool
     */
    function isEnd($overwriteVal)
    {
        return Carbon::parse($overwriteVal)->gte($this->end);
    }

    public function byDay($format = null)
    {
        return $this->by(function () use ($format) {
            $aDayAfter = $this->criteria->copy()->addDay();

            if (! is_null($format)) {
                return $aDayAfter->format($format);
            }

            return $aDayAfter->toDateTimeString();
        });
    }

    public function byWeek($format = null)
    {
        return $this->by(function () use ($format) {
            $aWeekAfter = $this->criteria->copy()->addWeek();

            if (! is_null($format)) {
                return $aWeekAfter->format($format);
            }

            return $aWeekAfter->toDateTimeString();
        });
    }

    public function byMonth($format = null)
    {
        return $this->by(function () use ($format) {
            $aMonthAfter = $this->criteria->copy()->addMonth();

            if (! is_null($format)) {
                return $aMonthAfter->format($format);
            }

            return $aMonthAfter->toDateTimeString();
        });
    }

    public function byYear($format = null)
    {
        return $this->by(function () use ($format) {
            $aYearAfter = $this->criteria->copy()->addYear();

            if (! is_null($format)) {
                return $aYearAfter->format($format);
            }

            return $aYearAfter->toDateTimeString();
        });
    }
}

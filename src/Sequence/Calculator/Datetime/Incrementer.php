<?php

namespace Ayaml\Sequence\Calculator\Datetime;

use Ayaml\Sequence\Calculator;

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
     * @return bool
     */
    function isEnd()
    {
        return $this->criteria->gte($this->end);
    }

    public function byDay($format = null)
    {
        return $this->by(function () use ($format) {
            $this->criteria->addDay();

            if (! is_null($format)) {
                return $this->criteria->format($format);
            }

            return $this->criteria->toDateTimeString();
        });
    }

    public function byWeek($format = null)
    {
        return $this->by(function () use ($format) {
            $this->criteria->addWeek();

            if (! is_null($format)) {
                return $this->criteria->format($format);
            }

            return $this->criteria->toDateTimeString();
        });
    }

    public function byMonth($format = null)
    {
        return $this->by(function () use ($format) {
            $this->criteria->addMonth();

            if (! is_null($format)) {
                return $this->criteria->format($format);
            }

            return $this->criteria->toDateTimeString();
        });
    }

    public function byYear($format = null)
    {
        return $this->by(function () use ($format) {
            $this->criteria->addYear();

            if (! is_null($format)) {
                return $this->criteria->format($format);
            }

            return $this->criteria->toDateTimeString();
        });
    }
}

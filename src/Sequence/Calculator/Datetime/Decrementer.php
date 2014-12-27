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
class Decrementer extends Calculator implements DatetimeCalculatorInterface
{

    /**
     * @return bool
     */
    function isEnd()
    {
        return $this->criteria->lte($this->end);
    }

    public function byDay($format = null)
    {
        return $this->by(function () use ($format) {
            $this->criteria->subDay();

            if (! is_null($format)) {
                return $this->criteria->format($format);
            }

            return $this->criteria->toDateTimeString();
        });
    }

    public function byWeek($format = null)
    {
        return $this->by(function () use ($format) {
            $this->criteria->subWeek();

            if (! is_null($format)) {
                return $this->criteria->format($format);
            }

            return $this->criteria->toDateTimeString();
        });
    }

    public function byMonth($format = null)
    {
        return $this->by(function () use ($format) {
            $this->criteria->subMonth();

            if (! is_null($format)) {
                return $this->criteria->format($format);
            }

            return $this->criteria->toDateTimeString();
        });
    }

    public function byYear($format = null)
    {
        return $this->by(function () use ($format) {
            $this->criteria->subYear();

            if (! is_null($format)) {
                return $this->criteria->format($format);
            }

            return $this->criteria->toDateTimeString();
        });
    }
}
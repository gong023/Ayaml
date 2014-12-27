<?php

namespace Ayaml\Sequence\Calculator\Datetime;

interface DatetimeCalculatorInterface
{
    public function by(callable $func);

    public function byDay($format = null);

    public function byWeek($format = null);

    public function byMonth($format = null);

    public function byYear($format = null);
}

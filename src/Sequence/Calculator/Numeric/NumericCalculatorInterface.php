<?php

namespace Ayaml\Sequence\Calculator\Numeric;

interface NumericCalculatorInterface
{
    public function byOne();

    public function by(callable $func);
}
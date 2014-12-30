<?php

namespace Ayaml\Sequence\Calculator\Numeric;

interface NumericCalculatorInterface
{
    public function by(callable $func);

    public function byOne();
}

<?php

namespace Ayaml\Sequence\Calculator\Numeric;

use Ayaml\Sequence\Calculator;

class Incrementer extends Calculator implements NumericCalculatorInterface
{
    public function byOne()
    {
        return $this->by(function () { return $this->criteria + 1; });
    }

    /**
     * @param $overwriteVal
     * @return bool
     */
    function isEnd($overwriteVal)
    {
        return $overwriteVal >= $this->end;
    }
}
<?php

namespace Ayaml\Sequence\Calculator\Numeric;

use Ayaml\Sequence\Calculator;

class Decrementer extends Calculator implements NumericCalculatorInterface
{
    public function byOne()
    {
        return $this->by(function () { $this->criteria -= 1; return $this->criteria; });
    }

    /**
     * @return bool
     */
    function isEnd()
    {
        return $this->criteria <= $this->end;
    }
}

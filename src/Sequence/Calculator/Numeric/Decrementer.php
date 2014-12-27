<?php

namespace Ayaml\Sequence\Calculator;

use Ayaml\Sequence\Calculator;
use Ayaml\Sequence\Calculator\Numeric\NumericCalculatorInterface;

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

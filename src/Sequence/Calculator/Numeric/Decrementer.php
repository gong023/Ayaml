<?php

namespace Ayaml\Sequence\Calculator\Numeric;

use Ayaml\Sequence\Calculator;

class Decrementer extends Calculator implements NumericCalculatorInterface
{
    /**
     * @return \Ayaml\ContainerCollection
     */
    public function byOne()
    {
        return $this->by(function ($criteria) { return $criteria - 1; });
    }

    /**
     * @param $overwriteVal
     * @return bool
     */
    public function isEnd($overwriteVal)
    {
        return $overwriteVal < $this->end;
    }
}

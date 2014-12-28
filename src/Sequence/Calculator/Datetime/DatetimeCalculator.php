<?php

namespace Ayaml\Sequence\Calculator\Datetime;

use Ayaml\Sequence\Calculator;

/**
 * Class DatetimeCalculator
 *
 * @package Ayaml\Sequence\Calculator\Datetime
 * @property \Carbon\Carbon end
 */
class DatetimeCalculator extends Calculator
{
    /**
     * @param $overwriteVal
     * @return bool
     * @throws \Exception
     */
    public function isEnd($overwriteVal)
    {
        throw new \Exception('implemented at subclass');
    }

    public function by(callable $func, $format = null)
    {
        if (! is_null($format)) {
            foreach ($this->containerCollection->dump() as $container) {

            }
        }

        return parent::by($func);
    }
}

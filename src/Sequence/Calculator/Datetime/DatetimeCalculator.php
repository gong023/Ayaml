<?php

namespace Ayaml\Sequence\Calculator\Datetime;

use Ayaml\Sequence\Calculator;
use Carbon\Carbon;

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

    /**
     * @param callable $func
     * @param null     $format
     * @return \Ayaml\ContainerCollection
     */
    public function by(callable $func, $format = null)
    {
        $ret = parent::by($func);

        if (! is_null($format)) {
            foreach ($this->containerCollection->getAll() as $container) {
                $rawData = $container->dump();
                $formattedDatetime = Carbon::parse($rawData[$this->targetKey])->format($format);
                $container->with([$this->targetKey => $formattedDatetime]);
            }
        }

        return $ret;
    }
}

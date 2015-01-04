<?php

namespace Ayaml\Sequence\Calculator\Datetime;

interface DatetimeCalculatorInterface
{
    /**
     * @return \Ayaml\ContainerCollection
     */
    public function by(callable $func);

    /**
 * @return \Ayaml\ContainerCollection
 */
public function byDay($format = null);

    /**
 * @return \Ayaml\ContainerCollection
 */
public function byWeek($format = null);

    /**
 * @return \Ayaml\ContainerCollection
 */
public function byMonth($format = null);

    /**
 * @return \Ayaml\ContainerCollection
 */
public function byYear($format = null);
}

<?php

namespace Ayaml\Sequence\Calculator\Numeric;

interface NumericCalculatorInterface
{
    /**
     * @return \Ayaml\ContainerCollection
     */
    public function by(callable $func);

    /**
     * @return \Ayaml\ContainerCollection
     */
    public function byOne();
}

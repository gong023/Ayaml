<?php
namespace Ayaml;

use Ayaml\Sequence\Calculator\Numeric\Decrementer as NumericDecrementer;
use Ayaml\Sequence\Calculator\Numeric\Incrementer as NumericIncrementer;
use Ayaml\Sequence\Calculator\Datetime\Decrementer as DatetimeDecrementer;
use Ayaml\Sequence\Calculator\Datetime\Incrementer as DatetimeIncrementer;
use Carbon\Carbon;

class ContainerCollection
{
    /**
     * @var Container[]
     */
    private $containers = [];

    /**
     * @var Container
     */
    private $baseContainer;

    public function __construct(Container $container)
    {
        $this->baseContainer = $container;
    }

    /**
     * @param $targetKey
     * @param $start
     * @param $end
     * @return NumericDecrementer|NumericIncrementer
     */
    public function range($targetKey, $start, $end)
    {
        $this->add($this->baseContainer->with([$targetKey => $start]));
        // TODO: type validation
        if ($start <= $end) {
            return new NumericIncrementer($this, $targetKey, $start, $end);
        }

        return new NumericDecrementer($this, $targetKey, $start, $end);
    }

    /**
     * @param $targetKey
     * @param $from
     * @param $to
     * @return DatetimeDecrementer|DatetimeIncrementer
     */
    public function between($targetKey, $from, $to)
    {
        // TODO: type validation
        $fromDate = Carbon::parse($from);
        $toDate = Carbon::parse($to);

        if ($fromDate->lte($toDate)) {
            return new DatetimeIncrementer($this, $targetKey, $fromDate, $toDate);
        }

        return new DatetimeDecrementer($this, $targetKey, $fromDate, $toDate);
    }

    public function add(Container $container)
    {
        array_push($this->containers, $container);
    }

    public function getBaseContainer()
    {
        return clone $this->baseContainer;
    }

    public function dump()
    {
        $containersArray = [];
        foreach ($this->containers as $container) {
            $containersArray[] = $container->dump();
        }

        return $containersArray;
    }
}

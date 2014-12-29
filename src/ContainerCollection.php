<?php

namespace Ayaml;

use Ayaml\Sequence\Calculator\Numeric\Decrementer as NumericDecrementer;
use Ayaml\Sequence\Calculator\Numeric\Incrementer as NumericIncrementer;
use Ayaml\Sequence\Calculator\Datetime\Decrementer as DatetimeDecrementer;
use Ayaml\Sequence\Calculator\Datetime\Incrementer as DatetimeIncrementer;
use Carbon\Carbon;

/**
 * Class ContainerCollection
 *
 * @package Ayaml
 */
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
     * @throws AyamlSeqInvalidTypeException
     */
    public function range($targetKey, $start, $end)
    {
        if (! is_numeric($start) || ! is_numeric($end)) {
            throw new AyamlSeqInvalidTypeException("'range' expects numeric var");
        }

        $this->add(0, $this->baseContainer->with([$targetKey => $start]));
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
     * @throws AyamlSeqInvalidTypeException
     */
    public function between($targetKey, $from, $to)
    {
        try {
            $fromDate = Carbon::parse($from);
            $toDate = Carbon::parse($to);
        } catch (\Exception $e) {
            throw new AyamlSeqInvalidTypeException("'between' expects date format string");
        }

        $this->add(0, $this->baseContainer->with([$targetKey => $fromDate->toDateTimeString()]));
        if ($fromDate->lte($toDate)) {
            return new DatetimeIncrementer($this, $targetKey, $fromDate, $toDate);
        }

        return new DatetimeDecrementer($this, $targetKey, $fromDate, $toDate);
    }

    /**
     * @param int       $index
     * @param Container $container
     */
    public function add($index, Container $container)
    {
        $this->containers[$index] = $container;
    }

    /**
     * @param $index
     * @return Container
     */
    public function get($index)
    {
        if (isset($this->containers[$index])) {
            return $this->containers[$index];
        }

        return clone $this->baseContainer;
    }

    /**
     * @return Container[]
     */
    public function getAll()
    {
        return $this->containers;
    }

    /**
     * @return array
     */
    public function dump()
    {
        $containersArray = [];
        foreach ($this->containers as $container) {
            $containersArray[] = $container->dump();
        }

        return $containersArray;
    }
}

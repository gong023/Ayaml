<?php
namespace Ayaml;

use Ayaml\Sequence\Calculator\Decrementer;
use Ayaml\Sequence\Calculator\Incrementer;

class ContainerCollection
{
    /**
     * @var Container[]
     */
    private $containers;

    /**
     * @var Container
     */
    private $baseContainer;

    public function __construct(Container $container)
    {
        $this->baseContainer = $container;
    }

    public function range($targetKey, $start, $end)
    {
        if ($start <= $end) {
            new Incrementer($this, $targetKey, $start, $end);
        }

        return new Decrementer($this, $targetKey, $start, $end);
    }

    public function between($targetKey, $from, $to)
    {
    }

    public function add(Container $container)
    {
        array_push($this->containers, $container);
    }

    public function getBaseContainer()
    {
        return $this->baseContainer;
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

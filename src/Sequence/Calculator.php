<?php

namespace Ayaml\Sequence;

use Ayaml\ContainerCollection;

abstract class Calculator
{
    public function __construct(ContainerCollection $containerCollection, $targetKey, $start, $end)
    {
        $this->containerCollection = $containerCollection;
        $this->targetKey = $targetKey;
        $this->criteria = $start;
        $this->end = $end;
    }

    /**
     * @param callable $func
     * @return ContainerCollection
     * @throws \Ayaml\AyamlSchemaNotSpecifiedException
     */
    public function by(callable $func)
    {
        $overwriteVal = $func($this->criteria);
        if ($this->isEnd($overwriteVal)) {
            return $this->containerCollection;
        }

        $this->criteria = $overwriteVal;
        $container = $this->containerCollection->getBaseContainer();
        $container->with([$this->targetKey => $overwriteVal]);
        $this->containerCollection->add($container);

        return $this->by($func);
    }

    /**
     * @param $overwriteVal
     * @return bool
     */
    abstract public function isEnd($overwriteVal);
}
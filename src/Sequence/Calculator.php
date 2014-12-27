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
        if ($this->isEnd()) {
            return $this->containerCollection;
        }
        $container = $this->containerCollection->getBaseContainer();
        $container->with([$this->targetKey => $func()]);

        $this->containerCollection->add($container);

        return $this->by($func);
    }

    /**
     * @return bool
     */
    abstract function isEnd();
}
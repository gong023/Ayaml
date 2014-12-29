<?php

namespace Ayaml\Sequence;

use Ayaml\ContainerCollection;

/**
 * Class Calculator
 *
 * @package Ayaml\Sequence
 */
abstract class Calculator
{
    protected $index = 0;

    /**
     * @param ContainerCollection $containerCollection
     * @param string              $targetKey
     * @param mixed               $start
     * @param mixed               $end
     */
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
            $this->index = 0;
            return $this->containerCollection;
        }

        $this->index += 1;
        $this->criteria = $overwriteVal;
        $container = $this->containerCollection->get($this->index)->with([$this->targetKey => $overwriteVal]);
        $this->containerCollection->add($this->index, $container);

        return $this->by($func);
    }

    /**
     * @param $overwriteVal
     * @return bool
     */
    abstract public function isEnd($overwriteVal);
}
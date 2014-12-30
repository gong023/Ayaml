<?php

namespace Ayaml\Test\Unit;

use Ayaml\Ayaml;
use Ayaml\ContainerCollection;

/**
 * Class ContainerCollectionTest
 *
 * @package Ayaml\Test\Unit
 */
class ContainerCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerCollection
     */
    private $containerCollection;

    public function setUp()
    {
        $container = Ayaml::file('user')->schema('valid_user');
        $this->containerCollection = new ContainerCollection($container);
    }

    /**
     * @test
     * @expectedException \Ayaml\AyamlSeqInvalidTypeException
     */
    public function throwsWhenRangeCalledInvalidType()
    {
        $this->containerCollection->range('foo', 'string', 'string');
    }

    /**
     * @test
     * @expectedException \Ayaml\AyamlSeqInvalidTypeException
     */
    public function throwsWhenBetweenCalledInvalidType()
    {
        $this->containerCollection->between('foo', 'invalid string', 'invalid_string');
    }
}

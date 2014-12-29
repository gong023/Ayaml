<?php
namespace Ayaml\Test\Unit;

use Ayaml\Container;
use Ayaml\Fixture\YamlData;

/**
 * Class ContainerTest
 * @package Ayaml\Test
 */
class ContainerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Container
     */
    private $subject;

    public function setUp()
    {
        $rawData = new YamlData(__DIR__ . '/../../SampleYaml/', 'user');
        $this->subject = new Container($rawData);
    }

    /**
     * @test
     */
    public function getSchemaCorrectly()
    {
        $ret = $this->subject->schema('valid_user');

        $this->assertInstanceOf('\Ayaml\Container', $ret);
    }

    /**
     * @test
     */
    public function getDumpedDataCorrectly()
    {
        $ret = $this->subject->schema('valid_user')->dump();
        $expected = [
            'id'      => 1,
            'name'    => 'Taro',
            'created' => '2014-01-01 00:00:00',
        ];

        $this->assertEquals($expected, $ret);
    }

    /**
     * @test
     */
    public function getOverwrittenDataCorrectly()
    {
        $ret = $this->subject->schema('valid_user')->with(['name' => 'John'])->dump();
        $expected = [
            'id'      => 1,
            'name'    => 'John',
            'created' => '2014-01-01 00:00:00',
        ];

        $this->assertEquals($expected, $ret);
    }

    /**
     * @test
     * @expectedException \Ayaml\AyamlSchemaNotSpecifiedException
     */
    public function throwExceptionWithInvalidOrder()
    {
        $this->subject->with(['name' => 'John'])->dump();
    }
}

<?php

namespace Ayaml\Test\Unit\Sequence\Calculator\Datetime;

use AssertChain\AssertChain;
use Ayaml\Ayaml;

class DecrementerTest extends \PHPUnit_Framework_TestCase
{
    use AssertChain;

    /**
     * @var \Ayaml\ContainerCollection
     */
    private $subject;

    public function setUp()
    {
        $container = Ayaml::file('user')->schema('valid_user');
        $this->subject = Ayaml::seq($container);
    }

    public function testByDay()
    {
        $days = $this->subject->between('created', '2014-01-03 00:00:00', '2014-01-01 00:00:00')->byDay();

        $this->centralizedAssert($days)
            ->beInstanceOf('\Ayaml\ContainerCollection')
            ->attributeContainsOnly('\Ayaml\Container', 'containers')
            ->attributeCount(3, 'containers');
    }

    public function testFormatting()
    {
        $days = $this->subject->between('created', '2014-01-01 00:00:00', '2014-01-03 00:00:00')->byDay('Y-m-d')->dump();

        $expected = [
            ['id' => 1, 'name' => 'Taro', 'created' => '2014-01-01'],
            ['id' => 1, 'name' => 'Taro', 'created' => '2014-01-02'],
            ['id' => 1, 'name' => 'Taro', 'created' => '2014-01-03'],
        ];

        $this->assertEquals($expected, $days);
    }

    public function testByWeek()
    {
        $days = $this->subject->between('created', '2014-01-21 00:00:00', '2014-01-01 00:00:00')->byWeek();

        $this->centralizedAssert($days)
            ->beInstanceOf('\Ayaml\ContainerCollection')
            ->attributeContainsOnly('\Ayaml\Container', 'containers')
            ->attributeCount(3, 'containers');
    }

    public function testByMonth()
    {
        $days = $this->subject->between('created', '2014-03-01 00:00:00', '2014-01-01 00:00:00')->byMonth();

        $this->centralizedAssert($days)
            ->beInstanceOf('\Ayaml\ContainerCollection')
            ->attributeContainsOnly('\Ayaml\Container', 'containers')
            ->attributeCount(3, 'containers');
    }

    public function testByYear()
    {
        $days = $this->subject->between('created', '2016-01-01 00:00:00', '2014-01-01 00:00:00')->byYear();

        $this->centralizedAssert($days)
            ->beInstanceOf('\Ayaml\ContainerCollection')
            ->attributeContainsOnly('\Ayaml\Container', 'containers')
            ->attributeCount(3, 'containers');
    }
}

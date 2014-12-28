<?php

namespace Ayaml\Test\Functional;

use AssertChain\AssertChain;
use Ayaml\Ayaml;

class FunctionalTest extends \PHPUnit_Framework_TestCase
{
    use AssertChain;

    /**
     * @var \Ayaml\Container
     */
    private $container;

    public function setUp()
    {
        $this->container = Ayaml::file('user')->schema('valid_user');
    }

    /**
     * @test
     */
    public function incrementNum()
    {
        $actual = Ayaml::seq($this->container)->range('id', 10, 12)->byOne()->dump();

        $expected = [
            ['id' => 10, 'name' => 'Taro', 'created' => '2014-01-01 00:00:00'],
            ['id' => 11, 'name' => 'Taro', 'created' => '2014-01-01 00:00:00'],
            ['id' => 12, 'name' => 'Taro', 'created' => '2014-01-01 00:00:00'],
        ];

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function decrementNum()
    {
        $actual = Ayaml::seq($this->container)->range('id', 10, 8)->byOne()->dump();

        $expected = [
            ['id' => 10, 'name' => 'Taro', 'created' => '2014-01-01 00:00:00'],
            ['id' => 9, 'name' => 'Taro', 'created' => '2014-01-01 00:00:00'],
            ['id' => 8, 'name' => 'Taro', 'created' => '2014-01-01 00:00:00'],
        ];

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function overwriteNumWithUserLogic()
    {
        $actual = Ayaml::seq($this->container)->range('id', 10, 13)->by(function ($id) { return $id + 2; })->dump();

        $expected = [
            ['id' => 10, 'name' => 'Taro', 'created' => '2014-01-01 00:00:00'],
            ['id' => 12, 'name' => 'Taro', 'created' => '2014-01-01 00:00:00'],
        ];

        $this->assertEquals($expected, $actual);
    }
}

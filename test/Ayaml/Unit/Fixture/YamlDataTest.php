<?php
namespace Ayaml\Test\Unit\Fixture;

use Ayaml\Fixture\YamlData;

/**
 * Class RawDataTest
 * @package Ayaml\Test
 */
class YamlDataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var YamlData
     */
    private $yamlData;

    public function setUp()
    {
        $this->yamlData = new YamlData(__DIR__ . '/../../../SampleYaml/', 'user.yml');
    }

    /**
     * @test
     */
    public function getSchemaCorrectly()
    {
        $validUser = $this->yamlData->getSchema('valid_user');
        $expected = [
            'id'      => 1,
            'name'    => 'Taro',
            'created' => '2014-01-01 00:00:00',
        ];

        $this->assertEquals($expected, $validUser);
    }

    /**
     * @test
     */
    public function getNestedSchema()
    {
        $nested = $this->yamlData->getSchema('nested.1.2.3.4.data');
        $expected = [
            'id'      => 2,
            'name'    => 'Jiro',
            'created' => '2014-01-01 00:00:00',
        ];

        $this->assertEquals($expected, $nested);
    }

    /**
     * @test
     * @expectedException \Ayaml\Fixture\AyamlSchemaNotFoundException
     */
    public function throwsExceptionWhenSchemaNotFound()
    {
        $this->yamlData->getSchema('no existing schema');
    }
}

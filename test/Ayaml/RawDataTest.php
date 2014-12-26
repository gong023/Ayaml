<?php
namespace Ayaml\Test;

use Ayaml\RawData;

/**
 * Class RawDataTest
 * @package Ayaml\Test
 */
class RawDataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RawData
     */
    private $subject;

    public function setUp()
    {
        $this->subject = new RawData(__DIR__ . '/../SampleYaml/User.yaml');
    }

    /**
     * @test
     */
    public function getSchemaCorrectly()
    {
        $validUser = $this->subject->getSchema('valid_user');
        $expected = [
            'id'      => 1,
            'name'    => 'Taro',
            'created' => '2014-01-01 00:00:00',
        ];

        $this->assertEquals($expected, $validUser);
    }

    /**
     * @test
     * @expectedException \Ayaml\AyamlSchemaNotFoundException
     */
    public function throwsExceptionWhenSchemaNotFound()
    {
        $this->subject->getSchema('no existing schema');
    }
}

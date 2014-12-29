<?php
namespace Ayaml\Test\Unit;

use Ayaml\Ayaml;

/**
 * Class AyamlTest
 * @package Ayaml\Test
 */
class AyamlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider fileNameProvider
     */
    public function returnContainerWithCorrectingYamlFileExtension($givenName)
    {
        $this->assertInstanceOf('\Ayaml\Container', Ayaml::file($givenName));
    }

    public static function fileNameProvider()
    {
        return [
            ['user'], ['user.yml'], ['user2.yaml']
        ];
    }

    /**
     * @test
     * @expectedException \Ayaml\Fixture\AyamlFixtureFileNotFoundException
     */
    public function throwsExceptionWhenFixtureFileNotFound()
    {
        Ayaml::file('no_existing_file');
    }
}

<?php
namespace Ayaml\Test;

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
    public function returnContainerWithCorrectingYamlFileExtension($given_name)
    {
        $this->assertInstanceOf('\Ayaml\Container', Ayaml::file($given_name));
    }

    public static function fileNameProvider()
    {
        return [
            ['User'], ['User.yml'], ['User.yaml']
        ];
    }

    /**
     * @test
     * @expectedException \Ayaml\AyamlFixtureFileNotFoundException
     */
    public function throwsExceptionWhenFixtureFileNotFound()
    {
        Ayaml::file('no_existing_file');
    }
}

<?php

namespace Ayaml;

use Ayaml\Fixture\YamlData;

/**
 * Class Ayaml
 * @package Ayaml
 */
class Ayaml
{
    /**
     * @var array
     */
    private static $basePaths = [];

    /**
     * @param string $fileName
     * @return Container
     * @throws AyamlBasePathNotFoundException
     */
    public static function file($fileName)
    {
        if (empty(self::$basePaths)) {
            throw new AyamlBasePathNotFoundException();
        }

        $yamlData = YamlData::load(self::$basePaths, $fileName);

        return new Container($yamlData);
    }

    /**
     * @param string $basePath
     */
    public static function registerBasePath($basePath)
    {
        self::$basePaths[] = preg_replace('/\/$/', '', $basePath);
    }

    /**
     * @param Container $container
     * @return ContainerCollection
     */
    public static function seq(Container $container)
    {
        return new ContainerCollection($container);
    }
}

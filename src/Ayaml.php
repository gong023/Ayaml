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
     * @var null|string
     */
    private static $basePath = null;

    /**
     * @param string $fileName
     * @return Container
     * @throws AyamlBasePathNotFoundException
     */
    public static function file($fileName)
    {
        if (empty(self::$basePath)) {
            throw new AyamlBasePathNotFoundException();
        }

        $yamlData = new YamlData(self::$basePath, $fileName);

        return new Container($yamlData);
    }

    /**
     * @param string $basePath
     */
    public static function registerBasePath($basePath)
    {
        self::$basePath = preg_replace('/\/$/', '', $basePath);
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

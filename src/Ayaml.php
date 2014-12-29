<?php

namespace Ayaml;

use Symfony\Component\Yaml\Yaml;

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
     * @throws AyamlFixtureFileNotFoundException
     */
    public static function file($fileName)
    {
        if (is_null(self::$basePath)) {
            throw new AyamlBasePathNotFoundException();
        }

        if (file_exists(self::$basePath. '/' . $fileName)) {
            $realFilePath = self::$basePath . '/' . $fileName;
        } elseif (file_exists(self::$basePath . '/' . $fileName . '.yml')) {
            $realFilePath = self::$basePath . '/' . $fileName . '.yml';
        } elseif (file_exists(self::$basePath . '/' . $fileName . '.yaml')) {
            $realFilePath = self::$basePath . '/' . $fileName . '.yaml';
        } else {
            throw new AyamlFixtureFileNotFoundException('base path: ' . self::$basePath . ' / file name:' . $fileName);
        }

        $rawData = new RawData(Yaml::parse($realFilePath));

        return new Container($rawData);
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

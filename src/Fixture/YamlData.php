<?php

namespace Ayaml\Fixture;

use Retry\Retry;
use Symfony\Component\Yaml\Yaml as SymfonyYaml;

/**
 * Class Yaml
 *
 * @package Ayaml\Fixture
 */
class YamlData
{
    const SCHEMA_DELIMITER = '.';

    /**
     * @var array
     */
    private $rawData = [];

    /**
     * @param array $rawData
     */
    public function __construct(array $rawData)
    {
        $this->rawData = $rawData;
    }

    /**
     * @param  string                       $schemaName
     * @return array
     */
    public function getSchema($schemaName)
    {
        return $this->getSchemaRecursively($schemaName, $this->rawData);
    }

    public function getRaw()
    {
        return $this->rawData;
    }

    /**
     * @param string $schemaName
     * @param        $rawData
     * @return array
     * @throws AyamlSchemaNotFoundException
     */
    private function getSchemaRecursively($schemaName, $rawData)
    {
        $specifiedKey = preg_replace('/\\' . self::SCHEMA_DELIMITER . '.*$/', '', $schemaName);
        if (empty($rawData[$specifiedKey])) {
            throw new AyamlSchemaNotFoundException('specified schema: ' . $schemaName);
        }

        $pattern = '/^\w+\\' . self::SCHEMA_DELIMITER . '/';
        if (preg_match($pattern, $schemaName)) {
            return $this->getSchemaRecursively(preg_replace($pattern, '', $schemaName), $rawData[$specifiedKey]);
        }

        return $rawData[$specifiedKey];
    }

    /**
     * @param array $paths
     * @param $fileName
     * @return YamlData
     */
    public static function load(array $paths, $fileName)
    {
        $rawData = (new Retry())
            ->retry(count($paths), function ($index) use ($paths, $fileName) {
                $basePath = $paths[$index];
                if (file_exists($basePath. '/' . $fileName)) {
                    $filePath = $basePath . '/' . $fileName;
                } elseif (file_exists($basePath . '/' . $fileName . '.yml')) {
                    $filePath = $basePath . '/' . $fileName . '.yml';
                } elseif (file_exists($basePath . '/' . $fileName . '.yaml')) {
                    $filePath = $basePath . '/' . $fileName . '.yaml';
                } else {
                    throw new AyamlFixtureFileNotFoundException('base path: ' . $basePath . ' / file name:' . $fileName);
                }

                return SymfonyYaml::parse(file_get_contents($filePath), true);
            });

        return new self($rawData);
    }
}

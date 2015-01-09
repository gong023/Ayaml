<?php

namespace Ayaml\Fixture;

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
     * @param string $basePath
     * @param string $fileName
     * @throws AyamlFixtureFileNotFoundException
     */
    public function __construct($basePath, $fileName)
    {
        if (file_exists($basePath. '/' . $fileName)) {
            $realFilePath = $basePath . '/' . $fileName;
        } elseif (file_exists($basePath . '/' . $fileName . '.yml')) {
            $realFilePath = $basePath . '/' . $fileName . '.yml';
        } elseif (file_exists($basePath . '/' . $fileName . '.yaml')) {
            $realFilePath = $basePath . '/' . $fileName . '.yaml';
        } else {
            throw new AyamlFixtureFileNotFoundException('base path: ' . $basePath . ' / file name:' . $fileName);
        }

        $this->rawData = SymfonyYaml::parse($realFilePath);
    }

    /**
     * @param  string                       $schemaName
     * @return array
     */
    public function getSchema($schemaName)
    {
        return $this->getSchemaRecursively($schemaName, $this->rawData);
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
}

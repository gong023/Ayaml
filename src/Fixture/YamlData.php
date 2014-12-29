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
    /**
     * @var array
     */
    private $rawData = [];

    /**
     * @param $basePath
     * @param $fileName
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
     * @throws AyamlSchemaNotFoundException
     */
    public function getSchema($schemaName)
    {
        if (empty($this->rawData[$schemaName])) {
            throw new AyamlSchemaNotFoundException('specified schema: ' . $schemaName);
        }

        return $this->rawData[$schemaName];
    }
}

<?php
namespace Ayaml;

use Symfony\Component\Yaml\Yaml;

/**
 * Class RawData
 * @package Ayaml
 */
class RawData
{
    /**
     * @var array
     */
    private $data;

    /**
     * @param string $path
     */
    public function __construct($path)
    {
        $this->data = Yaml::parse($path);
    }

    /**
     * @param  string                       $schemaName
     * @return array
     * @throws AyamlSchemaNotFoundException
     */
    public function getSchema($schemaName)
    {
        if (empty($this->data[$schemaName])) {
            throw new AyamlSchemaNotFoundException('specified schema: ' . $schemaName);
        }

        return $this->data[$schemaName];
    }
}

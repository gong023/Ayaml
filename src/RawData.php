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
     * @param  string                       $schema_name
     * @return array
     * @throws AyamlSchemaNotFoundException
     */
    public function getSchema($schema_name)
    {
        if (empty($this->data[$schema_name])) {
            throw new AyamlSchemaNotFoundException('specified schema: '.$schema_name);
        }

        return $this->data[$schema_name];
    }
}

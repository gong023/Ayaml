<?php
namespace Ayaml;

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
     * @param string $data
     */
    public function __construct($data)
    {
        $this->data = $data;
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

<?php
namespace Ayaml;

/**
 * Class Container
 * @package Ayaml
 */
class Container
{
    /**
     * @var RawData
     */
    private $raw_data;

    /**
     * @var null|array
     */
    private $result_data = null;

    /**
     * @param RawData $raw_data
     */
    public function __construct(RawData $raw_data)
    {
        $this->raw_data = $raw_data;
    }

    /**
     * @param string $name
     * @return $this
     * @throws AyamlSchemaNotFoundException
     */
    public function schema($name)
    {
        $this->result_data = $this->raw_data->getSchema($name);

        return $this;
    }

    /**
     * @param array $overwrites
     * @return $this
     * @throws AyamlSchemaNotSpecifiedException
     */
    public function with(array $overwrites)
    {
        if (is_null($this->result_data)) {
            $message = 'you should set schema before "with". ex.) Ayaml::file("f")->schema("s")->with(["k" => "v"])->dump()';
            throw new AyamlSchemaNotSpecifiedException($message);
        }
        foreach ($overwrites as $overwrite_key => $overwrite_val) {
            if (isset($this->result_data[$overwrite_key])) {
                $this->result_data[$overwrite_key] = $overwrite_val;
            }
        }

        return $this;
    }

    /**
     * @return array|null
     */
    public function dump()
    {
        return $this->result_data;
    }
}

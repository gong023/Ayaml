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
    private $rawData;

    /**
     * @var null|array
     */
    private $resultData = null;

    /**
     * @param RawData $rawData
     */
    public function __construct(RawData $rawData)
    {
        $this->rawData = $rawData;
    }

    /**
     * @param string $name
     * @return $this
     * @throws AyamlSchemaNotFoundException
     */
    public function schema($name)
    {
        $this->resultData = $this->rawData->getSchema($name);

        return $this;
    }

    /**
     * @param array $overwrites
     * @return $this
     * @throws AyamlSchemaNotSpecifiedException
     */
    public function with(array $overwrites)
    {
        if (is_null($this->resultData)) {
            $message = 'you should set schema before "with". ex.) Ayaml::file("f")->schema("s")->with(["k" => "v"])->dump()';
            throw new AyamlSchemaNotSpecifiedException($message);
        }
        foreach ($overwrites as $overwrite_key => $overwrite_val) {
            if (isset($this->resultData[$overwrite_key])) {
                $this->resultData[$overwrite_key] = $overwrite_val;
            }
        }

        return $this;
    }

    /**
     * @return array|null
     */
    public function dump()
    {
        return $this->resultData;
    }
}

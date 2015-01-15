<?php
namespace Ayaml;

use Ayaml\Fixture\AyamlSchemaNotFoundException;
use Ayaml\Fixture\YamlData;

/**
 * Class Container
 * @package Ayaml
 */
class Container
{
    /**
     * @var YamlData
     */
    private $yamlData;

    /**
     * @var null|array
     */
    private $resultData = null;

    /**
     * @param YamlData $yamlData
     */
    public function __construct(YamlData $yamlData)
    {
        $this->yamlData = $yamlData;
    }

    /**
     * @param string $name
     * @return $this
     * @throws AyamlSchemaNotFoundException
     */
    public function schema($name)
    {
        $this->resultData = $this->yamlData->getSchema($name);

        return $this;
    }

    /**
     * @param array $overwrites
     * @return $this
     * @throws AyamlNoExistingKeyException
     * @throws AyamlSchemaNotSpecifiedException
     */
    public function with(array $overwrites)
    {
        if (is_null($this->resultData)) {
            $message = 'you should set schema before "with". ex.) Ayaml::file("f")->schema("s")->with(["k" => "v"])->dump()';
            throw new AyamlSchemaNotSpecifiedException($message);
        }
        foreach ($overwrites as $overwriteKey => $overwriteVal) {
            if (! array_key_exists($overwriteKey, $this->resultData)) {
                throw new AyamlNoExistingKeyException("key: $overwriteKey does not exist.");
            }
            $this->resultData[$overwriteKey] = $overwriteVal;
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

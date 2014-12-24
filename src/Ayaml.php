<?php

namespace Ayaml;

/**
 * Class Ayaml
 * @package Ayaml
 */
class Ayaml
{
    /**
     * @var null|string
     */
    private static $base_path = null;

    /**
     * @param string $file_name
     * @return Container
     * @throws AyamlBasePathNotFoundException
     * @throws AyamlFixtureFileNotFoundException
     */
    public static function file($file_name)
    {
        if (is_null(self::$base_path)) {
            throw new AyamlBasePathNotFoundException();
        }

        if (file_exists(self::$base_path.'/'.$file_name)) {
            $real_file_path = self::$base_path.'/'.$file_name;
        } elseif (file_exists(self::$base_path.'/'.$file_name.'.yml')) {
            $real_file_path = self::$base_path.'/'.$file_name.'.yml';
        } elseif (file_exists(self::$base_path.'/'.$file_name.'.yaml')) {
            $real_file_path = self::$base_path.'/'.$file_name.'.yaml';
        } else {
            throw new AyamlFixtureFileNotFoundException('base path: '.self::$base_path.' / file name:'.$file_name);
        }

        $raw_data = new RawData($real_file_path);

        return new Container($raw_data);
    }

    /**
     * @param string $base_path
     */
    public static function registerBasePath($base_path)
    {
        self::$base_path = preg_replace('/\/$/', '', $base_path);
    }
}

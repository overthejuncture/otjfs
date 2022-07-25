<?php

namespace Core;

class Psr4Autoloader
{
    static public array $config = [];

    static public function load($class): void
    {
        $fullPath = dirname(__DIR__);
        $restOfClass = '';
        foreach (self::$config as $nsConfig) {
            if (str_starts_with($class, $nsConfig['prefix'])) {
                $restOfClass = str_replace($nsConfig['prefix'], '', $class);
                $restOfClass = str_replace("\\", DIRECTORY_SEPARATOR, $restOfClass);
                $fullPath .= DIRECTORY_SEPARATOR . $nsConfig['base_path'];
                break;
            }
        }
        $fileExists = false;
        $check = $fullPath . $restOfClass . '.php';
        if (file_exists($check)) {
            $fileExists = true;
            include $check;
        }
    }
}
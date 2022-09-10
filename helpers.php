<?php

use Core\Responses\ResponseFactory;

function config(string $path)
{
    return require 'configs' . DIRECTORY_SEPARATOR . $path . '.php';
}

function env($key, $default = null)
{
    $return = $default;
    $file = fopen('.env', 'r');
    while (($line = fgets($file)) !== false) {
        $line = rtrim($line, PHP_EOL);
        $arr = explode('=', $line);
        if (count($arr) !== 2)
            continue;
        if ($arr[0] === $key) {
            $return = $arr[1];
            break;
        }
    }
    return $return;
}

function dd($var, $die = true): void
{
    if (php_sapi_name() !== 'cli') {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    } else {
        var_dump($var);
    }
    if ($die)
        die();
}

function ddd(...$vars)
{
    foreach ($vars as $var) {
        dd($var, false);
    }
}

function mdd($die = true)
{
    dd(memory_get_usage() / 1024 . 'kb', $die);
}

/**
 * @return ResponseFactory
 */
function response(): ResponseFactory
{
    return ResponseFactory::getInstance();
}

function view(string $path, $data = [])
{
    return response()->view($path, $data);
}

function basePath(): string
{
    return __DIR__ . '/';
}

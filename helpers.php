<?php

use Core\Responses\ResponseFactory;

function dd($var, $die = true)
{
    if (php_sapi_name() !== 'cli') {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
        if ($die)
            die();
    } else {
        var_dump($var);
        if ($die)
            die();
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

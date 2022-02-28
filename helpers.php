<?php

use Core\BaseResponse;
use Core\ResponseFactory;
use Core\Singleton;

function dd($var, $die = true)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    if ($die)
        die();
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

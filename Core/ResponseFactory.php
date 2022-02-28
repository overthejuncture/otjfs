<?php

namespace Core;

class ResponseFactory extends Singleton
{
    public function json($data)
    {
        return JsonResponse::getInstance($data);
    }

    public function view(string $path, $data = [])
    {
        return ViewResponse::getInstance($path, $data);
    }
}

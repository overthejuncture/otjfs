<?php

namespace Core\Responses;

class ResponseFactory
{
    public function json($data)
    {
        return new JsonResponse($data);
    }

    public function view(string $path, $data = [])
    {
        return new ViewResponse($path, $data);
    }
}

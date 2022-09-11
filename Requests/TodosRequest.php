<?php

namespace Requests;

class TodosRequest extends \Core\Requests\Request
{
    public function rules(): array
    {
        return [
            'text' => 'required',
        ];
    }
}
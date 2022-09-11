<?php

namespace Core\Requests;

class Request
{
    private array $data;

    final public function __construct(GlobalRequest $request)
    {
        $this->fillDataFromGlobalRequest($request);
        $this->initializeRules();
    }

    protected function rules(): array
    {
        return [];
    }

    private function initializeRules()
    {
        $rules = $this->rules();
        // Пока только проверка на наличие
        foreach ($rules as $key => $rule) {
            if ($rule === 'required' && isset($this->data[$key])) {
                unset($rules[$key]);
            }
        }
        if (count($rules) > 0) {
            throw new \Exception('Not all parameters are present in request');
        }
    }

    private function fillDataFromGlobalRequest(GlobalRequest $request)
    {
        $this->data = $request->getData();
    }

    public function get(string $name)
    {
        return $this->data[$name] ?? null;
    }
}
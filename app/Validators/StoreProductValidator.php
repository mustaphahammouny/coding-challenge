<?php

namespace App\Validators;

use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Validation\Factory as Validator;

class StoreProductValidator extends Validator
{
    public function __construct(Translator $translator, Container $container = null)
    {
        $this->setPresenceVerifier(app('validation.presence'));

        parent::__construct($translator, $container);
    }

    /**
     * @param array $data
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function isValid(array $data): array
    {
        $rules = $this->rules();

        return parent::validate($data, $rules);
    }

    private function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ];
    }
}

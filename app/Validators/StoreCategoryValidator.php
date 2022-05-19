<?php

namespace App\Validators;

use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Validation\Factory as Validator;

class StoreCategoryValidator extends Validator
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

    /**
     * @return string[]
     */
    private function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'parent_category' => 'nullable|exists:categories,id',
        ];
    }
}

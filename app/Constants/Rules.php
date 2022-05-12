<?php

namespace App\Constants;

class Rules
{
    const STORE_CATEGORY_RULES = [
        'name' => 'required|max:255',
        'parent_category' => 'nullable|exists:categories,id',
    ];

    const STORE_PRODUCT_RULES = [
        'name' => 'required|max:255',
        'description' => 'required',
        'price' => 'required|numeric',
        'image' => 'required|image',
        'categories' => 'array',
        'categories.*' => 'exists:categories,id',
    ];
}

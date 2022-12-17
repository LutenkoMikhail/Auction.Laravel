<?php

namespace App\Http\Traits;

trait LotRulesTrait
{
    /**
     * The validation rule set.
     *
     * @var mixed
     */
    protected static $RULES = [
        'name' => ['required', 'min:5', 'max:50'],
        'description' => ['required', 'min:5', 'max:100'],
        'category_id' => ['unique:categories,id', 'array'],
    ];
}

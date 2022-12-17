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
        'name' => ['required', 'max:50'],
        'description' => ['required', 'max:100'],
        'category_id' => ['unique:categories,id', 'array'],
    ];
}

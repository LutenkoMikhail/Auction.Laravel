<?php

namespace App\Http\Traits;

trait CategoryRulesTrait
{
    /**
     * The validation rule set.
     *
     * @var mixed
     */
    protected static $RULES = [
        'name' => ['required', 'min:5', 'max:30', 'unique:categories'],
    ];
}

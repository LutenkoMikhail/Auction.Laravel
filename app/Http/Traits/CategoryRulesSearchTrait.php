<?php

namespace App\Http\Traits;

trait CategoryRulesSearchTrait
{
    /**
     * The validation rule set.
     *
     * @var mixed
     */
    protected static $RULES = [
        'category' => ['required', 'array', 'exists:Categories,id'],
    ];
}

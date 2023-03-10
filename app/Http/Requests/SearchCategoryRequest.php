<?php

namespace App\Http\Requests;

use App\Http\Traits\CategoryRulesSearchTrait;
use Illuminate\Foundation\Http\FormRequest;

class SearchCategoryRequest extends FormRequest
{
    use CategoryRulesSearchTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return static::$RULES;
    }
}

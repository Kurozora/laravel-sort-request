<?php

namespace Kurozora\SortRequest\Tests\Support\Requests;

use Illuminate\Foundation\Http\FormRequest as LaravelFormRequest;

class FormRequest extends LaravelFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    function authorize()
    {
        return true;
    }

    /**
     * Get the rules that the request enforces.
     *
     * @return array
     */
    function rules()
    {
        return [];
    }
}

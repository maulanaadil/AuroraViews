<?php

namespace App\Request;

use Illuminate\Foundation\Http\FormRequest;

class ReasonRequest extends FormRequest
{
    /**
     * Handle a failed authorization attempt.
     *
     * @return void
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Handle rules for validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'alasan' => 'required|string|max:255',
        ];
    }
}

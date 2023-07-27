<?php

namespace App\Request;

use Illuminate\Foundation\Http\FormRequest;

class AuthorizationRequest extends FormRequest
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
            'nama_hak' => 'required|string|max:255',
        ];
    }
}

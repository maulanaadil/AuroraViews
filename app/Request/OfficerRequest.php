<?php

namespace App\Request;

use Illuminate\Foundation\Http\FormRequest;

class OfficerRequest extends FormRequest
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
            'writer_name' => 'required|string|max:255',
            'notelp' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'writer_user_name' => 'required|string|max:255|unique:m_writer',
            'password' => 'required|string|min:8',
        ];
    }
}

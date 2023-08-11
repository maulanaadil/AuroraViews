<?php

namespace App\Request\Regional;

use Illuminate\Foundation\Http\FormRequest;

class SelectRegionalByIdRequest extends FormRequest
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
            
            'regional_id' => 'required|string',
        ];
    }
}

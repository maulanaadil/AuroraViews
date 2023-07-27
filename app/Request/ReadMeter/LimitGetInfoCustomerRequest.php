<?php

namespace App\Request\ReadMeter;

use Illuminate\Foundation\Http\FormRequest;

class LimitGetInfoCustomerRequest extends FormRequest
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
            'limit' => 'required|integer',
        ];
    }
}

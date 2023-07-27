<?php

namespace App\Request\ReadMeter;

use Illuminate\Foundation\Http\FormRequest;

class FormGetPositionCustomerRequest extends FormRequest
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
            'customer_code' => 'required|string|max:20',
            'bill_mergeym' => 'required|integer',
        ];
    }
}

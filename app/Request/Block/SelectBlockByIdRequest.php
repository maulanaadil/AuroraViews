<?php

namespace App\Request\Block;

use Illuminate\Foundation\Http\FormRequest;

class SelectBlockByIdRequest extends FormRequest
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
            'block_id' => 'required|integer',
        ];
    }
}

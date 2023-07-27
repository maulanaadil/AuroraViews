<?php

namespace App\Request\MappingOfficer;

use Illuminate\Foundation\Http\FormRequest;

class SelectAreaByOfficerIdRequest extends FormRequest
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
            'petugas_id' => 'required|integer',
        ];
    }
}

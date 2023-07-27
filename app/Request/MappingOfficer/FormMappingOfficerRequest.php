<?php

namespace App\Request\MappingOfficer;

use Illuminate\Foundation\Http\FormRequest;

class FormMappingOfficerRequest extends FormRequest
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
            'block_id' => 'required|integer',
            'rgn_id' => 'required|integer',
            'of_id' => 'required|integer',
            'tgl_download' => 'integer',
            'tgl_max_upload' => 'integer',
        ];
    }
}

<?php

namespace App\Request\AnomalyReport;

use Illuminate\Foundation\Http\FormRequest;

class AnomalyReportRequest extends FormRequest
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
            'office_id' => 'required|integer',
            'periode' => 'required|date',
            'regional_id' => 'required|integer',
            'block_id' => 'required|integer',
        ];
    }
}

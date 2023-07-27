<?php

namespace App\Request\AnomalyReport;

use Illuminate\Foundation\Http\FormRequest;

class AnomalyReportRequestOnlyPeriod extends FormRequest
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
            'periode' => 'required|date',
        ];
    }
}

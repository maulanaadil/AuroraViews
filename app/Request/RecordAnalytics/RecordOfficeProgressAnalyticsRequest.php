<?php

namespace App\Request\RecordAnalytics;

use Illuminate\Foundation\Http\FormRequest;

class RecordOfficeProgressAnalyticsRequest extends FormRequest
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
            'id_cabang' => 'required|integer',
            'periode' => 'required|date',
            'id_hak' => 'required|integer',
            'tanggal_awal' => 'date',
            'tanggal_akhir' => 'date',
        ];
    }
}

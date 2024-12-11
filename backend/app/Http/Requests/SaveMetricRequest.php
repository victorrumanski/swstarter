<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveMetricRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'metric_type' => 'required|string|max:50',
            'metric_data' => 'required|string|max:500'
        ];
    }
}
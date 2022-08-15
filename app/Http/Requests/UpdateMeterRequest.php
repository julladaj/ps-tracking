<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMeterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'meters.document_number' => [
                'required',
                'min:12',
                'max:12',
                'regex:/^([A-Z]{4}[0-9]{8})|(12[0-9]{10})/'
            ],
            'meters.document_date' => 'required|date',
            'meters.customer_name' => 'required|max:255'
        ];
    }
}

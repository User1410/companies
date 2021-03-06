<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|between:3,100',
            'last_name' => 'required|between:3,130',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'company_id' => 'nullable|exists:employess,id'
        ];
    }
}

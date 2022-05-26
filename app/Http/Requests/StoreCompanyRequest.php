<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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
            'name' => 'required|between:5,255',
            'email' => 'nullable|email|max:255',
            'logo' => 'bail|nullable|image|dimensions:min_width=100,min_height=100',
            'website' => 'nullbale|url'
        ];
    }
}

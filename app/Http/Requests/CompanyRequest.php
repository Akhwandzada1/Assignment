<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = request()->route('company');
        $rules = [
            'name' => 'required|unique:companies,name,'. $id . ',id',
            'email' => 'required|email',
            'website' => 'required|url',
            'logo' => 'required|image'

        ];

        if(request()->route()->methods[0] == 'PUT'){
            $rules['logo'] = '';
        }

        return $rules;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
        $id = request()->route('employee');
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'company_id' => 'required',
            'email' => 'required|unique:employees,email,' .$id. ',id',
            'phone' => 'required|string'

        ];
    }
}

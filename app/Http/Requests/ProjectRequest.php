<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use App\Models\Project;

class ProjectRequest extends FormRequest
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
        $id = request()->route('project');

        switch(request()->method){
            case 'POST':
                {
                    return [
                        'name' => 'required|unique:projects,name',
                        'detail' => 'required|string',
                        'client' => 'required|string',
                        'total_cost' => 'required|string',
                        'deadline' => 'required|date|after_or_equal:'.Carbon::today()->toDateString(),
                    ];
                }
            case 'PUT': {
                return [
                    'name' => 'required|unique:projects,name,' . $id . ',id',
                    'detail' => 'required|string',
                    'client' => 'required|string',
                    'total_cost' => 'required|string',
                    'deadline' => 'required|date|after_or_equal:'.Project::find($id)->deadline,
                ];
            }
        }
    }
}

<?php

namespace App\Http\Requests\Admin;

use App\Models\Department;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->input('id');

        return [
            'name' => [
                'required',
                'string',
                'between:2,255',
                (new Unique(Department::class))->ignore($id),
            ],

            'alias' => [
                'required',
                'string',
                'between:2,6',
                (new Unique(Department::class))->ignore($id),
            ],

            'faculty_id' => [
                'required',
                'exists:faculties,id'
            ],

        ];
    }
}

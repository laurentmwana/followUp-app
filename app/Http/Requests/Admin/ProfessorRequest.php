<?php

namespace App\Http\Requests\Admin;

use App\Models\Professor;
use App\Models\Department;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Foundation\Http\FormRequest;

class ProfessorRequest extends FormRequest
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
                'between:3,255'
            ],
            'firstname' => [
                'required',
                'string',
                'between:3,255'
            ],
            'phone' => [
                'required',
                (new Unique(Professor::class))->ignore($id)
            ],
            'sex' => [
                'required',
            ],
            'email' => [
                'required',
                'string',
                (new Unique(Professor::class))->ignore($id),
                'max:255'
            ],
            'department_id' => [
                'required',
                'exists:departments,id',
            ],
        ];
    }
}

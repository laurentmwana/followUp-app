<?php

namespace App\Http\Requests\Admin;

use App\Models\Course;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
                (new Unique(Course::class))->ignore($id),
            ],
            'credits' => [
                'required',
                'numeric',
            ],
            'description' => [
                'string',
                'between:10,5000',
            ],
            'levels' => [
                'array',
            ],

            'students' => [
                'array'
            ],

            'professor_id' => [
                'required',
                'exists:professors,id'
            ],
            'semester_id' => [
                'required',
                'exists:semesters,id'
            ],
            'group_id' => [
                'required',
                'exists:groups,id'
            ],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'levels' => $this->input('levels', []),
            'students' => $this->input('students', []),
        ]);
    }
}

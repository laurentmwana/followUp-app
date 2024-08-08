<?php

namespace App\Http\Requests\Admin;

use App\Query\QueryYear;
use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
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
        return [
            'note' => [
                'required',
                'numeric',
                'between:0,20'
            ],

            'student_id' => [
                'required',
                'exists:students,id'
            ],

            'course_id' => [
                'required',
                'exists:courses,id'
            ],

            'semester_id' => [
                'required',
                'exists:semesters,id'
            ],
            'year_id' => [
                'required',
                'exists:semesters,id'
            ],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'year_id' => QueryYear::currentYear()->id,
        ]);
    }
}

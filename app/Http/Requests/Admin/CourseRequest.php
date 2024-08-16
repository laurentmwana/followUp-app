<?php

namespace App\Http\Requests\Admin;

use App\Models\Course;
use App\Rules\MaxCreditGroupRule;
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
                new MaxCreditGroupRule(
                    $this->input()
                )
            ],
            'description' => [
                'max:5000',
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
}

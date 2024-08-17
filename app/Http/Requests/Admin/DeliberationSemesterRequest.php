<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DeliberationSemesterRequest extends FormRequest
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
            'semester' => [
                'required',
                'exists:semesters,id'
            ],
            'programme' => [
                'required',
                'exists:programmes,id'
            ],
            'option_id' => [
                'required',
                'exists:options,id'
            ],
        ];
    }
}

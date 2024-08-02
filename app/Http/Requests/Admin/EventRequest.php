<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'semester_id' => [
                'required',
                'exists:semesters,id',
            ],
            'level_id' => [
                'required',
                'exists:levels,id',
            ],
            'title' => [
                'required',
                'string',
                'between:5,255',
            ],
            'description' => [
                'required',
                'string',
                'between:10,5000',
            ],
            'published' => [
                'boolean',
            ],
            'start_date' => [
                'required',
                'date'
            ],
            'start_time' => [
                'required',
            ]
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use App\Helpers\Generator\GeneratorToken;
use App\Models\Student;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
                (new Unique(Student::class))->ignore($id),
            ],
            'firstname' => [
                'required',
                'string',
                'between:2,255',
            ],
            'lastname' => [
                'required',
                'string',
                'between:2,255',
            ],
            'email' => [
                'required',
                'string',
                'email',
                (new Unique(Student::class))->ignore($id)
            ],
            'sexy' => [
                'required',
                'string',
            ],
            'token' => [
                'required',
                'max:8',
                'min:8',
                (new Unique(Student::class))->ignore($id),
            ],
            'happy' => [
                'required',
                'date_format:Y-m-d'
            ],
            'level_id' => [
                'required',
                'exists:levels,id'
            ],
        ];
    }


    public function prepareForValidation()
    {
        $this->merge([
            'token' => $this->input('token') ?: GeneratorToken::token(8),
        ]);
    }
}

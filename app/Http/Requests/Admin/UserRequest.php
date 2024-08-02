<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                (new Unique(User::class))->ignore($id),
            ],
            'email' => [
                'required',
                'string',
                'between:2,255',
            ],
            'password' => [
                'string',
                Password::default(),
            ],
            'student_id' => [
                'required',
                'exists:students,id'
            ],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'password' => $this->input('password') ?: 'campus12345678',
        ]);
    }
}

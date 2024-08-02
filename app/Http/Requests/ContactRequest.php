<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'between:5,255'
            ],
            'subject' => [
                'required',
                'string',
                'between:5,255'
            ],
            'email' => [
                'required',
                'string',
                'max:255',
                'email',
            ],
            'message' => [
                'required',
                'string',
                'between:10,5000',
            ],
        ];
    }
}

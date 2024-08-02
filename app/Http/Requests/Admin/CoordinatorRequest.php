<?php

namespace App\Http\Requests\Admin;

use App\Models\Assistant;
use App\Models\Coordinator;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Foundation\Http\FormRequest;

class CoordinatorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->input('id');

        return [
            'name' => [
                'required',
                'string',
                'between:2,255',
                (new Unique(Coordinator::class))->ignore($id),
            ],

            'firstname' => [
                'required',
                'string',
                'between:3,255'
            ],

            'phone' => [
                'required',
                (new Unique(Coordinator::class))->ignore($id)
            ],

            'sex' => [
                'required',
            ],

            'email' => [
                'required',
                'string',
                (new Unique(Assistant::class))->ignore($id),
                'max:255'
            ],

            'courses' => [
                'array',
                'exists:courses,id'
            ],

            'professors' => [
                'array',
                'exists:professors,id'
            ],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'courses' => $this->input('courses', []),
            'professors' => $this->input('professors', []),
        ]);
    }
}

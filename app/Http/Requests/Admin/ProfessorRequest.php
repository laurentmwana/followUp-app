<?php

namespace App\Http\Requests\Admin;

use App\Rules\SexRule;
use App\Models\Professor;
use App\Models\Department;
use App\Rules\PhoneFormatRule;
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
            'sex' => [
                'required',
                'string',
                (new SexRule),
            ],
            'phone' => [
                'required',
                'string',
                (new PhoneFormatRule),
                (new Unique(Professor::class))->ignore($id)
            ],
        ];
    }
}

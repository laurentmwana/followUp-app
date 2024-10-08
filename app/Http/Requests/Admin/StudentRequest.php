<?php

namespace App\Http\Requests\Admin;

use App\Helpers\Generator\GeneratorToken;
use App\Models\Student;
use App\Rules\BetweenDateHappyRule;
use App\Rules\PhoneFormatRule;
use App\Rules\SexRule;
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
            ],
            'firstname' => [
                'required',
                'string',
                'between:2,255',
            ],
            'sex' => [
                'required',
                'string',
                (new SexRule),
            ],
            'phone' => [
                'required',
                'string',
                (new Unique(Student::class))->ignore($id),
                (new PhoneFormatRule),
            ],
            'happy' => [
                'required',
                'date_format:Y-m-d',
                new BetweenDateHappyRule
            ],
            'level' => [
                'required',
                'exists:levels,id'
            ],
            'choice' => [
                'required',
                'exists:options,id'
            ],
        ];
    }
}

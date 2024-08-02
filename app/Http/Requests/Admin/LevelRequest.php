<?php

namespace App\Http\Requests\Admin;

use App\Models\Year;
use App\Models\Level;
use App\Helpers\Faker\FakerDatabase;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Foundation\Http\FormRequest;

class LevelRequest extends FormRequest
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
                (new Unique(Level::class))->ignore($id),
            ],
            'description' => [
                'string',
                'between:10,5000',
            ],

            'option_id' => [
                'required',
                'exists:options,id'
            ],

            'year_id' => [
                'required',
                'exists:years,id'
            ]
        ];
    }

    public function prepareForValidation()
    {
        $year = FakerDatabase::year();

        $this->merge([
            'year_id' => $this->input('year_id') ?: $year->id,
        ]);
    }
}

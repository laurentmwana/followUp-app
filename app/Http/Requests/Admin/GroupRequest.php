<?php

namespace App\Http\Requests\Admin;

use App\Models\Group;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
                'between:2,20',
                (new Unique(Group::class))->ignore($id),
            ],
            'credits' => [
                'required',
                'numeric',
                'between:2,20',
            ],
            'category_id' => [
                'required',
                'exists:categories,id',
            ],
            'semester_id' => [
                'required',
                'exists:semesters,id',
            ],
        ];
    }
}

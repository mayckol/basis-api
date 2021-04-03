<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'task_type_id' => 'required|exists:task_types,id',
            'title' => 'required|string|max:255',
            'status' => ['sometimes', Rule::in(array_keys(config('tasks.status')))],
            'obs' => 'nullable|string|max:255',
        ];
    }
}

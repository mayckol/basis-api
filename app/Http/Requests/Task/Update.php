<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'task_type_id' => 'nullable|exists:task_types,id',
            'status' => ['nullable', Rule::in(array_keys(config('tasks.status')))],
            'obs' => 'nullable|string|max:255',
            'id' => 'required|exists:tasks,id',
        ];
    }

    public function all($keys = null)
    {
        return array_merge($this->request->all(), ['id' => $this->route('task')]);
    }
}

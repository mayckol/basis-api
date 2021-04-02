<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class Destroy extends FormRequest
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
            'id' => 'required|exists:tasks,id',
        ];
    }

    public function all($keys = null)
    {
        return array_merge($this->request->all(), ['id' => $this->route('task')]);
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !$this->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'priority' => 'required|int',
            'state' => 'required|string|max:255',
            'user_id' => 'int',
            'content' => 'nullable|string|max:255',
            'user_id_assigned' => 'nullable|int'
        ];
    }
}

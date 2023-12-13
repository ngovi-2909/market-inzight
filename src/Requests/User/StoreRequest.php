<?php

namespace mi\crud\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules():array
    {
        return [
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'email' => 'email|unique:users',
            'password' => 'min:3|required',
            'phone' => 'min:10|max:13',
            'is_super_user'=>'nullable',
            'is_active'=>'nullable',
        ];
    }
}

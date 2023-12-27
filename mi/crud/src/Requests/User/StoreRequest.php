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
            'email' => [
                'unique:users',
                'max:255',
                'regex:/^.+@.+$/i',
            ],
            'password' => 'min:3|max:255|required',
            'is_super_user'=>'nullable',
            'is_active'=>'nullable',
        ];
    }
}

<?php

namespace mi\crud\Requests\Email;

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
    public function rules()
    {
        return [
            'password'=>'min:3|max:255|required',
            'email' => 'regex:/^.+@.+$/i|max:255|unique:emails',
            'blocked_in'=>'nullable',
            'status'=>'nullable',
            'expired_time'=>'nullable',
            'created_by'=>'nullable'
        ];
    }
}

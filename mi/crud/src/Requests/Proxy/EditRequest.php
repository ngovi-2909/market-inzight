<?php

namespace mi\crud\Requests\Proxy;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
            'port'=>'required',
            'host'=>'required',
            'username'=>'nullable',
            'password'=>'nullable',
            'status'=>'nullable',
            'blocked_in' => 'nullable',
            'created_by'=>'nullable',
        ];
    }
}

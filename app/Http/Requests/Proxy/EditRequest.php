<?php

namespace App\Http\Requests\Proxy;

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
            'is_active'=>'nullable',
            'created_by'=>'nullable',
        ];
    }
}

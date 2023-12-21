<?php

namespace mi\crud\Imports;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use mi\crud\Models\Proxy;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportProxy implements ToModel,WithValidation, WithHeadingRow
{
    public function model(array $row)
    {
        return new Proxy([
            'host'=>$row['host'],
            'port'=>$row['port'],
            'username'=>$row['username'],
            'password'=>$row['password'],
            'status'=>$row['status'],
            'blocked_in'=>$row['blocked_in'],
            'created_by'=>auth()->user()->id,
        ]);
    }

    public function rules(): array
    {
        // TODO: Implement rules() method.
        return [
            'port'=>'required|min:0|max:64738',
            'host'=>'required',
            'username'=>'nullable',
            'password'=>'nullable',
            'status'=>'nullable',
            'blocked_in' => 'nullable',
            'created_by'=>'nullable',
        ];
    }
}

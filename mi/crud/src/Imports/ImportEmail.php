<?php

namespace mi\crud\Imports;

use Carbon\Carbon;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use mi\crud\Models\Email;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ImportEmail implements ToModel,WithValidation, WithHeadingRow
{
    public function model(array $row)
    {
        //
        return new Email([
            'email'=>$row['email'],
            'password'=>$row['password'],
            'status'=>$row['status'],
            'blocked_in'=>$row['blocked_in'],
            'expired_time'=> Carbon::parse(Date::excelToDateTimeObject($row['expired_time']))->format('Y-m-d'),
            'created_by'=>auth()->user()->id,
        ]);

    }

    public function rules(): array
    {
        // TODO: Implement rules() method.
        return [
            'password'=>'min:3|max:255',
            'email' => 'regex:/^.+@.+$/i|max:255|unique:emails',
            'blocked_in'=>'nullable',
            'status'=>'nullable',
            'expired_time'=>'nullable',
            'created_by'=>'nullable'
        ];
    }
}

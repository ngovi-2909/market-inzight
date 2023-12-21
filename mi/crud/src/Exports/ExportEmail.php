<?php

namespace mi\crud\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use mi\crud\Models\Email;

class ExportEmail implements FromCollection, WithHeadings, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Email::all()->map(function($user){
            return [
                'email'=>$user->email,
                'password'=>$user->password,
                'status'=>$user->status,
                'blocked_in'=>$user->blocked_in,
                'expired_time'=>$user->expired_time
            ];
        });
    }

    public function headings(): array
    {
        // TODO: Implement headings() method.
        return [
            'email',
            "password",
            "status",
            "blocked_in",
            "expired_time"
        ];
    }

    public function columnWidths(): array
    {
        // TODO: Implement columnWidths() method.
        return [
            'A'=>35,
            "B"=>20,
            "C"=>20,
            "D"=>20,
            "E"=>20
        ];
    }
}

<?php

namespace mi\crud\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use mi\crud\Models\Proxy;

class ExportProxy implements FromCollection, WithHeadings, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Proxy::all()->map(function($proxy){
                    return [
                        'host'=>$proxy->host,
                        'port'=>$proxy->port,
                        'username'=>$proxy->username,
                        'password'=>$proxy->password,
                        'status'=>$proxy->status,
                        'blocked_in'=>$proxy->blocked_in,
                    ];
                });
    }

    public function headings(): array
    {
        // TODO: Implement headings() method.
        return [
            "host",
            "port",
            "username",
            "password",
            "status",
            "blocked_in",
        ];
    }

    public function columnWidths(): array
    {
        // TODO: Implement columnWidths() method.
        return [
            'A'=>20,
            "B"=>20,
            "C"=>20,
            "D"=>20,
            "E"=>20,
            "F"=>20
        ];
    }
}

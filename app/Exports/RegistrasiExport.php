<?php

namespace App\Exports;

use App\Models\Registrasi;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class RegistrasiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Registrasi::select(

            'no_pendaftaran',
            'nama_lengkap',
            'tempat_lahir',
            'tanggal_lahir',
            'telepon',
            'status'

        )->get();
    }

    public function headings(): array
    {

        return [
            
            'No Pendaftaran',

            'Nama',

            'Tempat Lahir',

            'Tanggal Lahir',

            'Telepon',

            'Status'

        ];

    }
}

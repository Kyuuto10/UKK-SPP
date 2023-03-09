<?php

namespace App\Exports;

use App\Models\History;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithUpSerts;

class PembayaranExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return History::all();
    }

    public function headings(): array
    {
        return [    
            'id','id_petugas','nisn','nama','id_kelas','alamat','no_telp',
            'tgl_bayar','bulan_dibayar','tahun_dibayar','id_spp','jumlah_bayar',
            'created_at','updated_at'
        ];
    }
}

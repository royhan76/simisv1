<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;

class SantriExport extends StringValueBinder implements FromArray, WithStyles, WithCustomValueBinder
{

    protected $status;
    protected $tahun;

    public function __construct($status,$tahun)
    {
        $this->status = $status;
        $this->tahun  = $tahun;
    }

    public function array(): array
    {

        $query = DB::table('santri')
->leftJoin('wali','santri.santri_id','=','wali.santri_id')
->leftJoin('thn_masuk','santri.santri_id','=','thn_masuk.id_santri')
->leftJoin('thn_keluar','santri.santri_id','=','thn_keluar.id_santri');

if($this->tahun){
    $query->whereYear('thn_masuk.thn_masuk',$this->tahun);
}

$data = $query->select(
    'santri.no_induk',
    'santri.nama',
    'santri.kk',
    'santri.nik',
    'santri.khos',
    'wali.ayah',
    DB::raw("CONCAT(santri.tempat_lahir,', ',DATE_FORMAT(santri.tgl_lahir,'%d %M %Y')) as ttl"),
    'santri.jalan',
    'santri.kelurahan',
    'santri.kecamatan',
    'santri.kabupaten',
    'santri.provinsi',
    'thn_masuk.thn_masuk',
    'santri.no_tlp',
    'thn_keluar.thn_keluar'
)
->distinct('santri.santri_id')
->get();

        $rows = [];

        // Judul
        $rows[] = ["DATA NOMOR INDUK SANTRI BARU TAHUN ".$this->tahun];
        $rows[] = [];

        // Header
        $rows[] = [
            "NO",
            "NO INDUK",
            "NAMA LENGKAP",
            "NOMOR KK",
            "NIK",
            "KHOS",
            "AYAH",
            "TTL",
            "RT/RW",
            "DESA",
            "KEC",
            "KAB",
            "PROPINSI",
            "TH.MASUK",
            "NO HP WALI",
            "BOYONG"
        ];

        $no = 1;

        foreach($data as $d){

            $rows[] = [

                $no++,
                $d->no_induk,
                $d->nama,
                $d->kk,
                $d->nik,
                $d->khos,
                $d->ayah,
                $d->ttl,
                $d->jalan,
                $d->kelurahan,
                $d->kecamatan,
                $d->kabupaten,
                $d->provinsi,
                $d->thn_masuk,
                $d->no_tlp,
                $d->thn_keluar

            ];

        }

        return $rows;

    }

    public function styles(Worksheet $sheet)
    {

        return [

            // Judul
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 14
                ]
            ],

            // Header
            2 => [
                'font' => [
                    'bold' => true
                ]
            ]

        ];

    }

}

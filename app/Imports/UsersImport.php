<?php

namespace App\Imports;

use App\Models\Nasabah;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToCollection, WithStartRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $cek = Nasabah::where('rekening', $row[3])->first();
            if (!$cek) {
                Nasabah::create([
                    'rekening'  => $row[3], // misalnya kolom pertama adalah nama
                    'cabang' => $row[0], // misalnya kolom kedua adalah email
                    'unit' => $row[1], // misalnya kolom kedua adalah email
                    'nama' => $row[2], // misalnya kolom kedua adalah email
                    'alamat' => $row[7], // misalnya kolom kedua adalah email
                    'plafond' => $row[4], // misalnya kolom kedua adalah email
                    'jenis_agunan' => '', // misalnya kolom kedua adalah email
                    'kondisi' => '', // misalnya kolom kedua adalah email
                    'pokok' => $row[5], // misalnya kolom kedua adalah email
                    'bunga' => $row[6], // misalnya kolom kedua adalah email
                    'kolek' => null, // misalnya kolom kedua adalah email
                    'tanggal_permohonan' => null, // misalnya kolom kedua adalah email
                ]);
            }
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}

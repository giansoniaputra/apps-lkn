<?php

namespace App\Exports;

use App\Models\Nasabah;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class NasabahExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    public function collection()
    {
        return collect([]);
    }

    public function headings(): array
    {
        return ["Cabang", "Unit", "Nama", "Rekening", "Plafond", "Pokok", "Bunga", "Alamat", "Tanggal Permohonan"];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:I1')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'], // Warna hitam
                ],
            ],
            'font' => [
                'bold' => true, // Header bold
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        return [];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 20, // Lebar kolom A (User ID)
            'B' => 20, // Lebar kolom B (Full Name)
            'C' => 20, // Lebar kolom C (Email Address)
            'D' => 20, // Lebar kolom C (Email Address)
            'E' => 20, // Lebar kolom C (Email Address)
            'F' => 20, // Lebar kolom C (Email Address)
            'G' => 20, // Lebar kolom C (Email Address)
            'H' => 20, // Lebar kolom C (Email Address)
            'I' => 20, // Lebar kolom C (Email Address)
        ];
    }
}

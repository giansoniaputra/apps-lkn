<?php

namespace App\Http\Controllers;

use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\Nasabah;
use Illuminate\Http\Request;

class PDFController extends Controller
{

    protected $pdf;
    public function __construct()
    {
        $this->pdf = new FPDF;
    }

    public function setSatuHari($hari)
    {
        return 3600 * 24 * $hari;
    }

    public function angsuran($pokok)
    {
        return $pokok * 0.015;
    }

    public function rupiah($nominal)
    {
        return "Rp. " . number_format($nominal, 0, ',', '.');
    }

    public function permohonan($tanggal, $kunjungan = 1)
    {
        return strtotime($tanggal) - ($this->setSatuHari(35) * $kunjungan);
    }
    public function cetak_lkn(Request $request)
    {
        $nasabah = Nasabah::where('id', $request->id)->first();
        $this->pdf->AddFont('ArialNarrow', '', 'arialnarrow.php');
        $this->pdf->AddFont('ArialNarrowBold', '', 'arialnarrow_bold.php');
        $this->pdf->AddPage('P', 'letter');
        $this->pdf->SetFont('ArialNarrowBold', '', '12');
        $this->pdf->Cell(30);
        $this->pdf->Cell(10, 6, 'PT. BANK RAKYAT INDONESIA (PERSERO)', '0', 1, 'L');
        $this->pdf->Ln();
        $this->pdf->Cell(15);
        $this->pdf->Cell(10, 6, "CABANG", '0', 0, 'L');
        $this->pdf->Cell(15);
        $this->pdf->Cell(15, 6, ": $nasabah->cabang", '0', 0, 'L');
        $this->pdf->Ln();
        $this->pdf->Cell(15);
        $this->pdf->Cell(10, 6, "UNIT", '0', 0, 'L');
        $this->pdf->Cell(15);
        $this->pdf->Cell(15, 6, ": $nasabah->unit", '0', 0, 'L');
        $this->pdf->Cell(0, 8, '');
        $this->pdf->Ln();
        $this->pdf->SetFont('ArialNarrowBold', 'U', '12');
        $this->pdf->Cell(190, 6, 'FORMULIR KUNJUNGAN KEPADA PENUNGGAK', 0, 1, 'C');
        $this->pdf->Ln();
        $this->pdf->Cell(15);
        $this->pdf->SetFont('ArialNarrowBold', '', '12');
        $this->pdf->Cell(10, 6, "I. IDENTITAS NASABAH", '0', 0, 'L');
        $this->pdf->Cell(0, 8);
        $this->pdf->Ln();
        $this->pdf->SetFont('ArialNarrow', '', '12');
        $this->pdf->Cell(18);
        $this->pdf->Cell(10, 6, "A. Nomor Pangkal / Rekening", '0', 0, 'L');
        $this->pdf->Cell(45);
        $this->pdf->Cell(15, 6, ": $nasabah->rekening", '0', 0, 'L');
        $this->pdf->Ln();
        $this->pdf->Cell(18);
        $this->pdf->Cell(10, 6, "B. Nama", '0', 0, 'L');
        $this->pdf->Cell(45);
        $this->pdf->Cell(15, 6, ": $nasabah->nama", '0', 0, 'L');
        $this->pdf->Ln();
        $this->pdf->Cell(18);
        $this->pdf->Cell(10, 6, "C. Alamat", '0', 0, 'L');
        $this->pdf->Cell(45);
        $this->pdf->Cell(15, 6, ": $nasabah->alamat", '0', 0, 'L');
        $this->pdf->Cell(0, 8, '');
        $this->pdf->Ln();
        $this->pdf->Cell(15);
        $this->pdf->SetFont('ArialNarrowBold', '', '12');
        $this->pdf->Cell(10, 6, "II. DATA PINJAMAN NASABAH", '0', 0, 'L');
        $this->pdf->Cell(0, 8);
        $this->pdf->Ln();
        $this->pdf->SetFont('ArialNarrow', '', '12');
        $this->pdf->Cell(18);
        $this->pdf->Cell(10, 6, "A. Besarnya Plafond Semula", '0', 0, 'L');
        $this->pdf->Cell(45);
        $this->pdf->Cell(15, 6, ($nasabah->plafond > 0) ? ": " . $this->rupiah($nasabah->plafond) : ': ', '0', 0, 'L');
        $this->pdf->Ln();
        $this->pdf->Cell(18);
        $this->pdf->Cell(10, 6, "B. Jenis dan THLS Anggunan", '0', 0, 'L');
        $this->pdf->Cell(45);
        $this->pdf->Cell(15, 6, ": $nasabah->jenis_agunan", '0', 0, 'L');
        $this->pdf->Ln();
        $this->pdf->Cell(18);
        $this->pdf->Cell(10, 6, "C. Kondisi Pinjaman Saat Ini", '0', 0, 'L');
        $this->pdf->Cell(45);
        $this->pdf->Cell(15, 6, ": $nasabah->kondisi", '0', 0, 'L');
        $this->pdf->Ln();
        $this->pdf->Cell(18);
        $this->pdf->Cell(10, 6, "Angsuran", '0', 0, 'L');
        $this->pdf->Ln();
        $this->pdf->Cell(18);
        $this->pdf->Cell(10, 6, "Pokok", '0', 0, 'L');
        $this->pdf->Cell(45);
        $this->pdf->Cell(15, 6, ($nasabah->pokok > 0) ? ": " . $this->rupiah($nasabah->pokok) : ': ', '0', 0, 'L');
        $this->pdf->Ln();
        $this->pdf->Cell(18);
        $this->pdf->Cell(10, 6, "Bunga", '0', 0, 'L');
        $this->pdf->Cell(45);
        $this->pdf->Cell(15, 6, ($nasabah->bunga > 0) ? ": " . $this->rupiah($nasabah->bunga) : ': ', '0', 0, 'L');
        $this->pdf->Ln();
        $this->pdf->Cell(18);
        $this->pdf->Cell(10, 6, "Jumlah", '0', 0, 'L');
        $this->pdf->Cell(45);
        $this->pdf->Cell(15, 6, ($nasabah->bunga + $nasabah->pokok > 0) ? ": " . $this->rupiah($nasabah->bunga + $nasabah->pokok) : ': ', '0', 0, 'L');
        $this->pdf->Ln();
        $this->pdf->MultiCell(28, 2, '');
        $x = 12;
        $this->pdf->Cell(18);
        $this->pdf->SetXY(28, 140 - $x);
        $this->pdf->MultiCell(40, 10, "Keterangan", 1, 'C');
        $this->pdf->SetXY(68, 140 - $x);
        $this->pdf->MultiCell(113, 5, "", 1, 'C');
        $this->pdf->SetXY(68, 145 - $x);
        $this->pdf->MultiCell(22.6, 5, "I", 1, 'C');
        $this->pdf->SetXY(68 + (22.6 * 1), 145 - $x);
        $this->pdf->MultiCell(22.6, 5, "II", 1, 'C');
        $this->pdf->SetXY(68 + (22.6 * 2), 145 - $x);
        $this->pdf->MultiCell(22.6, 5, "III", 1, 'C');
        $this->pdf->SetXY(68 + (22.6 * 3), 145 - $x);
        $this->pdf->MultiCell(22.6, 5, "IV", 1, 'C');
        $this->pdf->SetXY(68 + (22.6 * 4), 145 - $x);
        $this->pdf->MultiCell(22.6, 5, "V", 1, 'C');
        $this->pdf->SetXY(28, 150 - $x);
        $this->pdf->MultiCell(40 + 113, 5, "Sisa Pinjaman", 1, 'L');
        $this->pdf->Cell(18);
        $this->pdf->SetXY(28, 155 - $x);
        $this->pdf->MultiCell(40, 5, "Sisa Tunggakan", 1, 'L');
        $this->pdf->SetXY(68, 155 - $x);
        $this->pdf->MultiCell(22.6, 5, "", 1, 'C');
        $this->pdf->SetXY(68 + (22.6 * 1), 155 - $x);
        $this->pdf->MultiCell(22.6, 5, "", 1, 'C');
        $this->pdf->SetXY(68 + (22.6 * 2), 155 - $x);
        $this->pdf->MultiCell(22.6, 5, "", 1, 'C');
        $this->pdf->SetXY(68 + (22.6 * 3), 155 - $x);
        $this->pdf->MultiCell(22.6, 5, "", 1, 'C');
        $this->pdf->SetXY(68 + (22.6 * 4), 155 - $x);
        $this->pdf->MultiCell(22.6, 5, "", 1, 'C');
        $this->pdf->Cell(18);
        $this->pdf->SetXY(28, 160 - $x);
        $this->pdf->MultiCell(40, 5, "* Pokok", 1, 'L');
        $this->pdf->SetXY(68, 160 - $x);
        $this->pdf->MultiCell(22.6, 5, "", 1, 'C');
        $this->pdf->SetXY(68 + (22.6 * 1), 160 - $x);
        $this->pdf->MultiCell(22.6, 5, "", 1, 'C');
        $this->pdf->SetXY(68 + (22.6 * 2), 160 - $x);
        $this->pdf->MultiCell(22.6, 5, "", 1, 'C');
        $this->pdf->SetXY(68 + (22.6 * 3), 160 - $x);
        $this->pdf->MultiCell(22.6, 5, "", 1, 'C');
        $this->pdf->SetXY(68 + (22.6 * 4), 160 - $x);
        $this->pdf->MultiCell(22.6, 5, "", 1, 'C');
        $this->pdf->Cell(18);
        $this->pdf->SetXY(28, 165 - $x);
        $this->pdf->MultiCell(40, 5, "* Bunga", 1, 'L');
        $this->pdf->SetXY(68, 165 - $x);
        $this->pdf->MultiCell(22.6, 5, "", 1, 'C');
        $this->pdf->SetXY(68 + (22.6 * 1), 165 - $x);
        $this->pdf->MultiCell(22.6, 5, "", 1, 'C');
        $this->pdf->SetXY(68 + (22.6 * 2), 165 - $x);
        $this->pdf->MultiCell(22.6, 5, "", 1, 'C');
        $this->pdf->SetXY(68 + (22.6 * 3), 165 - $x);
        $this->pdf->MultiCell(22.6, 5, "", 1, 'C');
        $this->pdf->SetXY(68 + (22.6 * 4), 165 - $x);
        $this->pdf->MultiCell(22.6, 5, "", 1, 'C');
        $this->pdf->Cell(18);
        $this->pdf->SetXY(28, 170 - $x);
        $this->pdf->MultiCell(40, 5, "Kolektabilitas", 1, 'L');
        $this->pdf->SetXY(68, 170 - $x);
        $this->pdf->MultiCell(22.6, 5, "", 1, 'C');
        $this->pdf->SetXY(68 + (22.6 * 1), 170 - $x);
        $this->pdf->MultiCell(22.6, 5, "", 1, 'C');
        $this->pdf->SetXY(68 + (22.6 * 2), 170 - $x);
        $this->pdf->MultiCell(22.6, 5, "", 1, 'C');
        $this->pdf->SetXY(68 + (22.6 * 3), 170 - $x);
        $this->pdf->MultiCell(22.6, 5, "", 1, 'C');
        $this->pdf->SetXY(68 + (22.6 * 4), 170 - $x);
        $this->pdf->MultiCell(22.6, 5, "", 1, 'C');
        $this->pdf->Cell(0, 4, '');
        // TABLE 2
        $this->pdf->Ln();
        $this->pdf->Cell(15);
        $this->pdf->SetFont('ArialNarrowBold', '', '12');
        $this->pdf->Cell(10, 6, "III. KUNJUNGAN", '0', 0, 'L');
        $this->pdf->Cell(0, 10);
        $this->pdf->Ln();
        $this->pdf->SetFont('ArialNarrow', '', '10');
        $this->pdf->Cell(18);
        $this->pdf->SetXY(28, 188 - $x);
        $this->pdf->MultiCell(13, 10, "Ke", 1, 'C');
        $this->pdf->SetXY(68 - 27, 188 - $x);
        $this->pdf->MultiCell(24, 10, "Tanggal", 1, 'C');
        $this->pdf->SetXY(68 - 27 + 24, 188 - $x);
        $this->pdf->MultiCell(19.3, 5, "Bertemu Dengan", 1, 'C');
        $this->pdf->SetXY(68 - 27 + 19.3 + 24, 188 - $x);
        $this->pdf->MultiCell(19.3 * 2, 5, "Janji Bayar", 1, 'C');
        $this->pdf->SetXY(68 - 27 + 19.3 + 24, 188 + 5 - $x);
        $this->pdf->MultiCell(19.3, 5, "Tanggal", 1, 'C');
        $this->pdf->SetXY(68 - 27 + (19.3 * 2) + 24, 188 + 5 - $x);
        $this->pdf->MultiCell(19.3, 5, "Besarnya", 1, 'C');
        $this->pdf->SetXY(68 - 27 + (19.3 * 3) + 24, 188 - $x);
        $this->pdf->MultiCell(19.3, 5, "Pembayaran (Rp)", 1, 'C');
        $this->pdf->SetXY(68 - 27 + (19.3 * 4) + 24, 188 - $x);
        $this->pdf->MultiCell(19.3, 10, "Ttd Nasabah", 1, 'C');
        $this->pdf->SetXY(68 - 27 + (19.3 * 5) + 24, 188 - $x);
        $this->pdf->MultiCell(19.3, 5, "Paraf Petugas", 1, 'C');
        //ISI TABLE 2.1
        $y = -5;
        $z = 1;
        $y += 5;
        $this->pdf->Cell(18);
        $this->pdf->SetXY(28, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(13, 5, $z++, 1, 'C');
        $this->pdf->SetXY(68 - 27, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(24, 5, date('d/m/Y', $this->permohonan($nasabah->tanggal_permohonan, 3)), 1, 'C');
        $this->pdf->SetXY(68 - 27 + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "YMP", 1, 'C');
        $this->pdf->SetXY(68 - 27 + 19.3 + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, '', 1, 'C');
        $this->pdf->SetXY(68 - 27 + (19.3 * 2) + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "", 1, 'C');
        $this->pdf->SetXY(68 - 27 + (19.3 * 3) + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "", 1, 'C');
        $this->pdf->SetXY(68 - 27 + (19.3 * 4) + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "", 1, 'C');
        $this->pdf->SetXY(68 - 27 + (19.3 * 5) + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "", 1, 'C');
        $y += 5;
        $this->pdf->Cell(18);
        $this->pdf->SetXY(28, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(13, 5, $z++, 1, 'C');
        $this->pdf->SetXY(68 - 27, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(24, 5, date('d/m/Y', $this->permohonan($nasabah->tanggal_permohonan, 3) + 35 * 24 * 3600), 1, 'C');
        $this->pdf->SetXY(68 - 27 + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "YMP", 1, 'C');
        $this->pdf->SetXY(68 - 27 + 19.3 + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, date('d/m/Y', $this->permohonan($nasabah->tanggal_permohonan)), 1, 'C');
        $this->pdf->SetXY(68 - 27 + (19.3 * 2) + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, $this->rupiah($this->angsuran($nasabah->plafond)), 1, 'C');
        $this->pdf->SetXY(68 - 27 + (19.3 * 3) + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "", 1, 'C');
        $this->pdf->SetXY(68 - 27 + (19.3 * 4) + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "", 1, 'C');
        $this->pdf->SetXY(68 - 27 + (19.3 * 5) + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "", 1, 'C');
        $y += 5;
        $this->pdf->Cell(18);
        $this->pdf->SetXY(28, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(13, 5, $z++, 1, 'C');
        $this->pdf->SetXY(68 - 27, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(24, 5, date('d/m/Y', $this->permohonan($nasabah->tanggal_permohonan)), 1, 'C');
        $this->pdf->SetXY(68 - 27 + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "YMP", 1, 'C');
        $this->pdf->SetXY(68 - 27 + 19.3 + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "", 1, 'C');
        $this->pdf->SetXY(68 - 27 + (19.3 * 2) + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "", 1, 'C');
        $this->pdf->SetXY(68 - 27 + (19.3 * 3) + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "", 1, 'C');
        $this->pdf->SetXY(68 - 27 + (19.3 * 4) + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "", 1, 'C');
        $this->pdf->SetXY(68 - 27 + (19.3 * 5) + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "", 1, 'C');
        $y += 5;
        $this->pdf->Cell(18);
        $this->pdf->SetXY(28, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(13, 5, $z++, 1, 'C');
        $this->pdf->SetXY(68 - 27, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(24, 5, '', 1, 'C');
        $this->pdf->SetXY(68 - 27 + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "", 1, 'C');
        $this->pdf->SetXY(68 - 27 + 19.3 + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "", 1, 'C');
        $this->pdf->SetXY(68 - 27 + (19.3 * 2) + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "", 1, 'C');
        $this->pdf->SetXY(68 - 27 + (19.3 * 3) + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "", 1, 'C');
        $this->pdf->SetXY(68 - 27 + (19.3 * 4) + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "", 1, 'C');
        $this->pdf->SetXY(68 - 27 + (19.3 * 5) + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "", 1, 'C');
        $y += 5;
        $this->pdf->Cell(18);
        $this->pdf->SetXY(28, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(13, 5, $z++, 1, 'C');
        $this->pdf->SetXY(68 - 27, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(24, 5, '', 1, 'C');
        $this->pdf->SetXY(68 - 27 + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "", 1, 'C');
        $this->pdf->SetXY(68 - 27 + 19.3 + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "", 1, 'C');
        $this->pdf->SetXY(68 - 27 + (19.3 * 2) + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "", 1, 'C');
        $this->pdf->SetXY(68 - 27 + (19.3 * 3) + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "", 1, 'C');
        $this->pdf->SetXY(68 - 27 + (19.3 * 4) + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "", 1, 'C');
        $this->pdf->SetXY(68 - 27 + (19.3 * 5) + 24, 188 - $x + 10 + $y);
        $this->pdf->MultiCell(19.3, 5, "", 1, 'C');
        // KETERANGAN KUNJUNGAN
        // TABLE 2
        $this->pdf->Ln();
        $this->pdf->Cell(15);
        $this->pdf->SetFont('ArialNarrowBold', '', '12');
        $this->pdf->Cell(10, 6, "IV. KETERANGAN KUNJUNGAN", '0', 0, 'L');
        $this->pdf->Cell(0, 10);
        $this->pdf->SetFont('ArialNarrow', '', '12');
        $this->pdf->Ln();
        $this->pdf->Cell(18);
        $this->pdf->Cell(10, 6, "Kunjungan ke 1", '0', 0, 'L');
        $this->pdf->Cell(18);
        $this->pdf->Cell(10, 6, ($request->keterangan != '') ? ": " . $request->keterangan : ': Usaha debitur yang bersangkutan sedang mengalami penurunan', '0', 0, 'L');
        $this->pdf->Ln();
        $this->pdf->Cell(18);
        $this->pdf->Cell(10, 6, "Kunjungan ke 2", '0', 0, 'L');
        $this->pdf->Cell(18);
        $this->pdf->Cell(10, 6, ": YMP akan melakukan pembayaran angsuran", '0', 0, 'L');
        $this->pdf->Ln();
        $this->pdf->Cell(18);
        $this->pdf->Cell(10, 6, "Kunjungan ke 3", '0', 0, 'L');
        $this->pdf->Cell(18);
        $this->pdf->Cell(10, 6, ": YMP masih kesulitan untuk melakukan pembayaran", '0', 0, 'L');
        $this->pdf->Ln();
        $this->pdf->Cell(18);
        $this->pdf->Cell(10, 6, "Kunjungan ke 4", '0', 0, 'L');
        $this->pdf->Cell(18);
        $this->pdf->Cell(10, 6, ": ", '0', 0, 'L');
        $this->pdf->Ln();
        $this->pdf->Cell(18);
        $this->pdf->Cell(10, 6, "Kunjungan ke 5", '0', 0, 'L');
        $this->pdf->Cell(18);
        $this->pdf->Cell(10, 6, ": ", '0', 0, 'L');
        // PRINT
        $this->pdf->Output("Lembar Kunjungan Nasabah a.n. $nasabah->nama.pdf", 'I');
        exit;
    }
}

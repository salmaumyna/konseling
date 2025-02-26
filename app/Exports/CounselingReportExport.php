<?php
namespace App\Exports;

use App\Models\CounselingReport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CounselingReportExport implements FromCollection, WithHeadings, WithMapping
{
    protected $counselingReports;

    public function __construct($counselingReports)
    {
        $this->counselingReports = $counselingReports;
    }

    public function collection()
    {
        return $this->counselingReports;
    }

    public function headings(): array
    {
        return ['NIS', 'Nama Siswa', 'Kelas', 'Jurusan', 'Tanggal', 'Guru BK', 'Status', 'Deskripsi', 'Alasan Penolakan'];
    }

    public function map($counselingReports): array
    {
        return [
            $counselingReports->student->nis,
            $counselingReports->student->nama,
            $counselingReports->class->name ?? '-',
            $counselingReports->major->name ?? '-',
            $counselingReports->date,
            $counselingReports->teacher->name ?? '-',
            $counselingReports->status == 'approved' ? 'Disetujui' : ($counselingReports->status == 'pending' ? 'Menunggu' : 'Ditolak'),
            $counselingReports->description,
            $counselingReports->reason ?? '-',
        ];
    }
}

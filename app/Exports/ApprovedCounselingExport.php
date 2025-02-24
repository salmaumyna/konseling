<?php
namespace App\Exports;

use App\Models\CounselingReport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ApprovedCounselingExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return CounselingReport::where('status', 'approved')
            ->with(['student', 'class', 'major', 'teacher'])
            ->get()
            ->map(function ($report) {
                return [
                    'NIS' => $report->student->nis,
                    'Nama Siswa' => $report->student->nama,
                    'Kelas' => $report->class->name ?? '-',
                    'Jurusan' => $report->major->name ?? '-',
                    'Guru BK' => $report->teacher->name ?? '-',
                    'Tanggal Konseling' => $report->date,
                    'Deskripsi' => $report->description,
                ];
            });
    }

    public function headings(): array
    {
        return ['NIS', 'Nama Siswa', 'Kelas', 'Jurusan', 'Guru BK', 'Tanggal Konseling', 'Deskripsi'];
    }
}

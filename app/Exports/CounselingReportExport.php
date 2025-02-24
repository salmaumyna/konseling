<?php
namespace App\Exports;

use App\Models\CounselingReport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CounselingReportExport implements FromCollection, WithHeadings, WithMapping
{
    protected $nis, $status;

    public function __construct($nis, $status)
    {
        $this->nis = $nis;
        $this->status = $status;
    }

    public function collection()
    {
        $query = CounselingReport::with(['student', 'class', 'major'])->orderBy('date', 'desc');

        if ($this->nis) {
            $query->whereHas('student', function ($q) {
                $q->where('nis', 'like', '%' . $this->nis . '%');
            });
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return ['NIS', 'Nama Siswa', 'Kelas', 'Jurusan', 'Tanggal', 'Guru BK', 'Status', 'Deskripsi', 'Alasan Penolakan'];
    }

    public function map($counselingReport): array
    {
        return [
            $counselingReport->student->nis,
            $counselingReport->student->nama,
            $counselingReport->class->name ?? '-',
            $counselingReport->major->name ?? '-',
            $counselingReport->date,
            $counselingReport->teacher->name ?? '-',
            ucfirst($counselingReport->status),
            $counselingReport->description,
            $counselingReport->reason ?? '-',
        ];
    }
}

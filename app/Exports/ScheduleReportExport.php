<?php

namespace App\Exports;

use App\Models\UnavailableSchedule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ScheduleReportExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = UnavailableSchedule::with('user'); // Pastikan relasi ke tabel user

        if ($this->request->filled('name')) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->request->name . '%');
            });
        }

        if ($this->request->filled('date_start')) {
            $query->whereDate('date', '>=', $this->request->date_start);
        }

        if ($this->request->filled('date_end')) {
            $query->whereDate('date', '<=', $this->request->date_end);
        }

        return $query->orderBy('date', 'desc')->orderBy('time', 'asc')->get();
    }

    public function headings(): array
    {
        return ['No', 'Nama', 'Tanggal', 'Jam'];
    }

    public function map($schedule): array
    {
        return [
            $schedule->id,
            $schedule->user->name ?? 'Tidak diketahui', // Ambil nama user dari relasi
            $schedule->date->format('d F Y'),
            $schedule->time ? $schedule->time->format('H:i') : 'Seharian'
        ];
    }
}
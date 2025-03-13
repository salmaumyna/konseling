<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\UnavailableSchedule;
use Illuminate\Http\Request;
use App\Exports\ScheduleReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ScheduleReportController extends Controller
{
    /**
     * Middleware untuk memastikan hanya admin yang bisa mengakses
     */
    

    /**
     * Display a listing of the schedule reports.
     */
    public function index(Request $request)
    {
        $query = UnavailableSchedule::query();
        
        // Filter by name if provided
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        
        // Filter by date range
        if ($request->filled('date_start')) {
            $query->whereDate('date', '>=', $request->date_start);
        }
        
        if ($request->filled('date_end')) {
            $query->whereDate('date', '<=', $request->date_end);
        }
        
        $schedules = $query->orderBy('date', 'desc')
                          ->orderBy('time', 'asc')
                          ->get();
        
        return view('Reportjadwal.index', compact('schedules'));
    }

    /**
     * Export the schedules to Excel
     */
    public function download(Request $request)
    {
        return Excel::download(new ScheduleReportExport($request), 'laporan-jadwal-tidak-tersedia.xlsx');
    }
}
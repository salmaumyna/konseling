<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $year = $request->input('year', date('Y'));

        $approved = array_fill(0, 12, 0);

        $query = DB::table('counseling_reports')
            ->selectRaw('MONTH(date) as month, COUNT(*) as total')
            ->whereYear('date', $year)
            ->where('status', 'approved');

        if ($user->role !== 'admin') {
            $query->where('teacher_id', $user->id);
        }

        $counselingData = $query->groupBy('month')->pluck('total', 'month');

        foreach ($counselingData as $month => $total) {
            $approved[$month - 1] = $total;
        }

        return view('management.dashboard', compact('user', 'year', 'approved'));
    }
}
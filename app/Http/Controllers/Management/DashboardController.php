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

        // Inisialisasi array kosong untuk 12 bulan (default 0)
        $approved = array_fill(0, 12, 0);

        if ($user->role === 'admin') {
            $counselingData = DB::table('counseling_reports')
                ->selectRaw('MONTH(date) as month, COUNT(*) as total')
                ->whereYear('date', $year)
                ->where('status', 'approved')
                ->groupBy('month')
                ->pluck('total', 'month'); // Gunakan pluck agar langsung key-value

            foreach ($counselingData as $month => $total) {
                $approved[$month - 1] = $total; // Masukkan ke array index yang sesuai
            }
        }

        return view('management.dashboard', compact('user', 'year', 'approved'));
    }
}

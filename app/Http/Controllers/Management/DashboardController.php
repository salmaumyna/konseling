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

    $query = DB::table('counseling_reports')
        ->selectRaw('MONTH(date) as month, COUNT(*) as total')
        ->whereYear('date', $year)
        ->where('status', 'approved');

    // Jika user bukan admin, hanya ambil data counseling yang dia setujui
    if ($user->role !== 'admin') {
        $query->where('teacher_id', $user->id);
    }

    $counselingData = $query->groupBy('month')->pluck('total', 'month');

    foreach ($counselingData as $month => $total) {
        $approved[$month - 1] = $total; // Masukkan ke array index yang sesuai
    }

    return view('management.dashboard', compact('user', 'year', 'approved'));
}


}

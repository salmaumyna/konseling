<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('management.dashboard', compact('user'));
    }
}

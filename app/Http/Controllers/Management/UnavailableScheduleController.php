<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\UnavailableSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UnavailableScheduleController extends Controller
{
    /**
     * Display a listing of the unavailable schedules.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = UnavailableSchedule::query();
        
        if ($request->filled('date_start')) {
            $query->whereDate('date', '>=', $request->date_start);
        }
        
        if ($request->filled('date_end')) {
            $query->whereDate('date', '<=', $request->date_end);
        }
        
        $schedules = $query->orderBy('date', 'desc')->get();
        
        return view('management.penjadwalan.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new unavailable schedule.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('management.penjadwalan.create');
    }

    /**
     * Store a newly created unavailable schedule in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => [
                'required', 
                'date', 
                'after_or_equal:today',
            ],
            'times' => 'nullable|array',
            'times.*' => 'date_format:H:i',
        ], [
            'date.after_or_equal' => 'Tanggal harus sama dengan atau setelah hari ini.',
            'times.*.date_format' => 'Format jam tidak valid.',
        ]);

        // If no times selected, create a full-day unavailability
        if (empty($request->times)) {
            // Check if full-day already exists
            $exists = UnavailableSchedule::where('user_id', Auth::id())
                ->where('date', $request->date)
                ->whereNull('time')
                ->exists();
                
            if (!$exists) {
                UnavailableSchedule::create([
                    'user_id' => Auth::id(),
                    'date' => $request->date,
                    'time' => null,
                ]);
            }
        } else {
            // For each selected time, create a separate record
            foreach ($request->times as $time) {
                // Check if this specific time already exists
                $exists = UnavailableSchedule::where('user_id', Auth::id())
                    ->where('date', $request->date)
                    ->where('time', $time)
                    ->exists();
                    
                if (!$exists) {
                    UnavailableSchedule::create([
                        'user_id' => Auth::id(),
                        'date' => $request->date,
                        'time' => $time,
                    ]);
                }
            }
        }

        return redirect()->route('mgt.schedules.index')
                        ->with('success', 'Jadwal tidak tersedia berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified unavailable schedule.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedule = UnavailableSchedule::findOrFail($id);
        
        // Ensure the user only edits their own schedule
        if ($schedule->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Get all scheduled times for this date to handle multiple selections
        if ($schedule->time === null) {
            // This is a full-day unavailability
            $scheduledTimes = [];
        } else {
            // For a specific time, we need to check if other times exist for this date
            $scheduledTimes = UnavailableSchedule::where('user_id', Auth::id())
                ->where('date', $schedule->date)
                ->whereNotNull('time')
                ->pluck('time')
                ->map(function($time) {
                    return $time->format('H:i');
                })
                ->toArray();
        }

        return view('management.penjadwalan.edit', compact('schedule', 'scheduledTimes'));
    }

    /**
     * Update the specified unavailable schedule in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $schedule = UnavailableSchedule::findOrFail($id);
        
        // Ensure the user only updates their own schedule
        if ($schedule->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'date' => [
                'required', 
                'date', 
                'after_or_equal:today',
            ],
            'times' => 'nullable|array',
            'times.*' => 'date_format:H:i',
        ], [
            'date.after_or_equal' => 'Tanggal harus sama dengan atau setelah hari ini.',
            'times.*.date_format' => 'Format jam tidak valid.',
        ]);

        // First delete all existing records for this date
        UnavailableSchedule::where('user_id', Auth::id())
            ->where('date', $request->date)
            ->delete();
            
        // Then recreate based on the selected times
        if (empty($request->times)) {
            // Create a full-day unavailability
            UnavailableSchedule::create([
                'user_id' => Auth::id(),
                'date' => $request->date,
                'time' => null,
            ]);
        } else {
            // For each selected time, create a separate record
            foreach ($request->times as $time) {
                UnavailableSchedule::create([
                    'user_id' => Auth::id(),
                    'date' => $request->date,
                    'time' => $time,
                ]);
            }
        }

        return redirect()->route('mgt.schedules.index')
                        ->with('success', 'Jadwal tidak tersedia berhasil diperbarui.');
    }

    /**
     * Remove the specified unavailable schedule from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
        $schedule = UnavailableSchedule::findOrFail($id);
        
        // Ensure the user only deletes their own schedule
        if ($schedule->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $schedule->delete();

        return redirect()->route('mgt.schedules.index')
                        ->with('success', 'Jadwal tidak tersedia berhasil dihapus.');
    }
    
    /**
     * Check if a specific date/time is available for a user.
     * This method can be used by other controllers or API endpoints.
     *
     * @param  int  $userId
     * @param  string  $date
     * @param  string|null  $time
     * @return bool
     */
    public static function isAvailable($userId, $date, $time = null)
    {
        // Check if there's a full-day unavailability
        $fullDayUnavailable = UnavailableSchedule::where('user_id', $userId)
            ->where('date', $date)
            ->whereNull('time')
            ->exists();
            
        if ($fullDayUnavailable) {
            return false;
        }
        
        // If no specific time was provided, then the date is available (partially)
        if ($time === null) {
            return true;
        }
        
        // Check if there's a specific time unavailability
        $timeUnavailable = UnavailableSchedule::where('user_id', $userId)
            ->where('date', $date)
            ->where('time', $time)
            ->exists();
            
        return !$timeUnavailable;
    }
    
}
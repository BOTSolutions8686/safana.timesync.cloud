<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hrm\Attendance\Attendance;
use App\Exports\AttendenceExport;
use Maatwebsite\Excel\Facades\Excel;

class AttendenceExportCont extends Controller
{
    public function export(Request $request) 
    {
        $recordsattend = Attendance::all();

        // Dynamically generate array of months for the dropdown
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = date("F", mktime(0, 0, 0, $i, 1));
        }

        // Dynamically generate array of years for the dropdown
        $currentYear = date('Y');
        $years = range($currentYear - 8, $currentYear + 0);

        $selectedMonth = $request->input('month', now()->month);
        $selectedYear = $request->input('year', now()->year);
    
        $filteredRecords = Attendance::with('user')  // Eager load the "user" relation
        ->whereYear('date', $selectedYear)
        ->whereMonth('date', $selectedMonth)
        ->get();
    
            return view('backend.attendance.attendance.monthlyreport', [
                'recordsattend' => $filteredRecords,
                'months' => $months,
                'years' => $years,
                'selectedMonth' => $selectedMonth,
                'selectedYear' => $selectedYear,
            ]);
            
    }
}

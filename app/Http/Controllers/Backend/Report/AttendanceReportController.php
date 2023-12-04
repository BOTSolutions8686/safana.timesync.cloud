<?php

namespace App\Http\Controllers\Backend\Report;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Brian2694\Toastr\Facades\Toastr;
use App\Repositories\Admin\RoleRepository;
use App\Helpers\CoreApp\Traits\DateHandler;
use App\Models\coreApp\Relationship\RelationshipTrait;
use App\Repositories\Report\AttendanceReportRepository;
use App\Repositories\Hrm\Attendance\AttendanceRepository;
use App\Repositories\Hrm\Department\DepartmentRepository;

class AttendanceReportController extends Controller
{
    use RelationshipTrait, DateHandler;

    protected $attendanceReport;
    protected $department;
    protected $roleRepository;
    protected $attendance_repo;
    protected $userRepository;
    protected $users;

    public function __construct(
        AttendanceReportRepository $attendanceReportRepository,
        DepartmentRepository $department,
        UserRepository $users,
        AttendanceRepository $attendance_repo, 
        RoleRepository $roleRepository
    ) {
        $this->attendanceReport = $attendanceReportRepository;
        $this->department = $department;
        $this->users = $users;
        $this->attendance_repo = $attendance_repo;
        $this->roleRepository = $roleRepository;
    }

    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                return $this->attendanceReport->table($request);
            }
            $data['class']  = 'report_attendance_table';
            $data['fields'] = $this->attendance_repo->report_fields();
            $data['checkbox'] = true;
            $data['table']     = route('attendance.index');
            $data['url_id']    = 'report_attendance_table_url';
            $data['title'] = _trans('attendance.Attendance History');
            $data['departments'] = $this->department->getAll();
			$data['users'] = $this->users->getAll();
            return view('backend.report.attendance.index', compact('data'));
        } catch (\Throwable $th) {
            Toastr::error(_trans('response.Something went wrong.'), 'Error');
            return redirect()->back();
        }
    }

    public function liveTracking(Request $request)
    {
        $data['title'] = _trans('attendance.Live Tracking');
        $data['roles'] = $this->roleRepository->getAll();
        $data['date'] = $request->date ? $request->date : date('Y-m-d');
        return view('backend.report.live_tracking.index', compact('data'));
    }

    public function liveTrackingEmployee(Request $request)
    {
        return $this->users->liveTrackingEmployee($request);
    }

    public function locationHistory(Request $request)
    {
        $data['title'] = _trans('attendance.Location History');
        $data['users'] = $this->users->getAll();
        $data['date'] = $request->date ? $request->date : date('Y-m-d');
        $data['user'] = $request->user ? $request->user : null;
        return view('backend.report.live_tracking.location_history', compact('data'));
    }

    public function employeeLocationHistory(Request $request)
    {
        return $this->users->employeeLocationHistory($request);
    }

    public function employeeAttendanceHistory(User $user)
    {
        $data['title'] = _trans('attendance.Show attendance');
        $data['show'] = $user;
        $data['monthArray'] = $this->getCurrentMonthDays();
        return view('backend.attendance.attendance.show', compact('data'));
    }

    public function reportDataTable(Request $request)
    {
        
        return $this->attendanceReport->attendanceDatatable($request);
    }

    public function singleReportDataTable(Request $request, User $user)
    {
        if ($request->month) {
            $monthArray = $this->getSelectedMonthDays($request->month);
        } else {
            $monthArray = $this->getCurrentMonthDays();
        }
        return $this->attendanceReport->singleAttendanceDatatable($user, $request, $monthArray);
    }

    public function singleAttendanceSummaryReport(Request $request, User $user)
    {
        $monthlySummary = $this->attendanceReport->singleAttendanceSummary($user, $request);
        return view('backend.attendance.attendance.summary.summary', compact('monthlySummary'));
    }


    public function checkInDetails(Request $request)
    {
        $data['title'] = _trans('attendance.Attendance Details');
        $data['attendance'] = $this->attendanceReport->attendanceDetails($request);
        return view('backend.modal.attendance_details', compact('data'));
    }

    // Detail Attendance Report
    public function PresentAttendance(Request $request){
        try {
            if ($request->ajax()) {
                return $this->attendanceReport->PresentAttentanceTable($request);
            }
            $data['class']  = 'report_attendance_table';
            $data['fields'] = $this->attendance_repo->present_report_fields();
            $data['checkbox'] = true;
            $data['table']     = route('PresentAttendanceReport.PresentAttendance');
            $data['url_id']    = 'report_present_attendance_table_url';
            $data['title'] = _trans('attendance.Present Attendance Report');
            $data['departments'] = $this->department->getAll();
            $data['users'] = $this->users->getAll();
            return view('backend.report.attendance.presentattendance', compact('data'));
        } catch (\Throwable $th) {
            Toastr::error(_trans('response.Something went wrong.'), 'Error');
            return redirect()->back();
        }
    }

    // Late Attendance Report
    public function LateAttendance(Request $request){
        try {
            if ($request->ajax()) {
                return $this->attendanceReport->LateAttentanceTable($request);
            }
            $data['class']  = 'report_attendance_table';
            $data['fields'] = $this->attendance_repo->late_report_fields();
            $data['checkbox'] = true;
            $data['table']     = route('LateAttendanceReport.LateAttendance');
            $data['url_id']    = 'report_late_attendance_table_url';
            $data['title'] = _trans('attendance.Late Attendance Report');
            $data['departments'] = $this->department->getAll();
            $data['users'] = $this->users->getAll();
            return view('backend.report.attendance.lateattendance', compact('data'));
        } catch (\Throwable $th) {
            Toastr::error(_trans('response.Something went wrong.'), 'Error');
            return redirect()->back();
        }
    }

    // Absent Attendance Report
    public function AbsentAttendance(Request $request){
        try {
            if ($request->ajax()) {
                return $this->attendanceReport->AbsentAttentanceTable($request);
            }
            $data['class']  = 'report_attendance_table';
            $data['fields'] = $this->attendance_repo->absent_report_fields();
            $data['checkbox'] = true;
            $data['table']     = route('AbsentAttendanceReport.AbsentAttendance');
            $data['url_id']    = 'report_absent_attendance_table_url';
            $data['title'] = _trans('attendance.Absent Attendance Report');
            $data['departments'] = $this->department->getAll();
            $data['users'] = $this->users->getAll();
            return view('backend.report.attendance.absentattendance', compact('data'));
        } catch (\Throwable $th) {
            Toastr::error(_trans('response.Something went wrong.'), 'Error');
            return redirect()->back();
        }
    }
	
	// No Checkout Attendance Report
    public function NoCheckout(Request $request){
        try {
            if ($request->ajax()) {
                return $this->attendanceReport->NoCheckoutAttentanceTable($request);
            }
            $data['class']  = 'report_attendance_table';
            $data['fields'] = $this->attendance_repo->nocheckout_report_fields();
            $data['checkbox'] = true;
            $data['table']     = route('NoCheckoutReport.NoCheckout');
            $data['url_id']    = 'report_nocheckout_attendance_table_url';
            $data['title'] = _trans('attendance.NoCheckout Attendance Report');
            $data['departments'] = $this->department->getAll();
            $data['users'] = $this->users->getAll();
            return view('backend.report.attendance.nocheckoutattendance', compact('data'));
        } catch (\Throwable $th) {
            Toastr::error(_trans('response.Something went wrong.'), 'Error');
            return redirect()->back();
        }
    }

}

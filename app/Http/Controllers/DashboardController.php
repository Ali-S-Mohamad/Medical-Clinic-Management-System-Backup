<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct() {
    $this->middleware('role:Admin')->only('index');
    }

    /**
     * Display The dashboard for admin that containing overview about the clinic status
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $totalPatients  = Patient::count();
        $totalDoctors   = User::role('doctor')  ->count();
        $totalEmployees = User::role('employee')->count();
        $departments    = Department::count();
        $doctors        = User::role('doctor')->get();
        $hasAvgRating   = User::role('doctor')->whereHas('employee', function ($query) { 
            $query->whereNotNull('avg_ratings'); }) ->exists();

        $active_departments   = Department::where('status', 1)->count();
        $inactive_departments = Department::where('status', 0)->count();
        $active_appointments  = Appointment::where('status', 'scheduled')->count();
        $pending_appointments  = Appointment::where('status', 'pending')->get();
        $scheduling_appointments  = Appointment::where('status', 'scheduled')->get();
        // Merging pending and scheduled appointments in one object
        $upcoming_appointments = $pending_appointments->merge($scheduling_appointments);


        $statistics=[
            'totalPatients' => $totalPatients,
            'totalDoctors'  => $totalDoctors,
            'totalEmployees'=> $totalEmployees,
            'active_departments'   => $active_departments,
            'inactive_departments' => $inactive_departments,
            'active_appointments'  => $active_appointments ,
            'pending_appointments'  => $pending_appointments ,
            'scheduling_appointments'  => $scheduling_appointments ,
            'upcoming_appointments'  => $upcoming_appointments ,
            'doctors'       => $doctors,
            'hasAvgRating'  => $hasAvgRating ,

        ];
        return view('admin.dashboard',compact('statistics'));
    }
}

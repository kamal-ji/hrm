<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AttendanceTemplate;
use Illuminate\Http\Request;

class AttendanceTemplateController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $templates = AttendanceTemplate::where('business_id', auth()->user()->getParentBusiness()->id);
            
            return datatables()->of($templates)
                ->addColumn('actions', function ($template) {
                    return view('backend.attendance-templates.actions', compact('template'))->render();
                })
                ->editColumn('attendance_mode', function ($template) {
                    return $template->attendance_mode == 1 ? 'Yes' : 'No';
                })
                ->editColumn('attendance_on_holiday', function ($template) {
                    return $template->attendance_on_holiday == 1 ? 'Yes' : 'No';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.attendance-templates.index');
    }

    public function create(Request $request){
        return view('backend.attendance-templates.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'attendance_mode' => 'required',
            'attendance_on_holiday' => 'required',
            'track_in_out_time' => 'required',
            'no_attendance_without_punch_out' => 'required',
            'allow_multiple_punches' => 'required',
            'enable_auto_approval' => 'required',
            'attendance_items.*' => 'required',
            'automation_items.*' => 'required',
            'approval_days' => 'required',
            'mark_absent_on_previous_days' => 'required',
            'effective_working_hours' => 'required',
        ]);
        
        $attendanceTemplate = new AttendanceTemplate();
        $attendanceTemplate->business_id = auth()->user()->getParentBusiness()->id;
        $attendanceTemplate->name = $request->name;
        $attendanceTemplate->attendance_mode = $request->attendance_mode;
        $attendanceTemplate->attendance_on_holiday = $request->attendance_on_holiday;
        $attendanceTemplate->track_in_out_time = $request->track_in_out_time;
        $attendanceTemplate->no_attendance_without_punch_out = $request->no_attendance_without_punch_out;
        $attendanceTemplate->allow_multiple_punches = $request->allow_multiple_punches;
        $attendanceTemplate->enable_auto_approval = $request->enable_auto_approval;
        $attendanceTemplate->attendance_items = $request->attendance_items;
        $attendanceTemplate->automation_items = $request->automation_items;
        $attendanceTemplate->approval_days = $request->approval_days;
        $attendanceTemplate->mark_absent_on_previous_days = $request->mark_absent_on_previous_days;
        $attendanceTemplate->effective_working_hours = $request->effective_working_hours;
        $attendanceTemplate->save();

        return response()->json([
            'success' => true,
            'message' => 'Attendance template created successfully',
            'redirect_url' => route('attendance-template.index')
        ]);
    }
    
    public function edit(Request $request, $id){
        $attendanceTemplate  = AttendanceTemplate::find($id);
        return view('backend.attendance-templates.edit', compact('attendanceTemplate'));
    }
    
    public function update(Request $request, $id){
        $template = AttendanceTemplate::find($id);
        $template->name = $request->name;
        $template->attendance_mode = $request->attendance_mode;
        $template->attendance_on_holiday = $request->attendance_on_holiday;
        $template->track_in_out_time = $request->track_in_out_time;
        $template->no_attendance_without_punch_out = $request->no_attendance_without_punch_out;
        $template->allow_multiple_punches = $request->allow_multiple_punches;
        $template->enable_auto_approval = $request->enable_auto_approval;
        $template->attendance_items = $request->attendance_items;
        $template->automation_items = $request->automation_items;
        $template->approval_days = $request->approval_days;
        $template->mark_absent_on_previous_days = $request->mark_absent_on_previous_days;
        $template->effective_working_hours = $request->effective_working_hours;
        $template->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Attendance template updated successfully',
            'redirect_url' => route('attendance-template.index')
        ]);
    }
    
    public function destroy(Request $request, $id){
        $template = AttendanceTemplate::find($id);
        $template->delete();
        
        return redirect()->route('backend.attendance-templates.index')->with('success', 'Attendance template deleted successfully');
    }
}

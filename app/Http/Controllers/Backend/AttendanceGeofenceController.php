<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AttendanceGeofence;
use Illuminate\Http\Request;

class AttendanceGeofenceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $geofences = AttendanceGeofence::where('business_id', auth()->user()->getParentBusiness()->id);
            
            return datatables()->of($geofences)
                ->addColumn('actions', function ($geofence) {
                    return view('backend.attendance-geofences.actions', compact('geofence'))->render();
                })
                ->editColumn('attendance_mode', function ($geofence) {
                    return $geofence->attendance_mode == 1 ? 'Yes' : 'No';
                })
                ->editColumn('attendance_on_holiday', function ($geofence) {
                    return $geofence->attendance_on_holiday == 1 ? 'Yes' : 'No';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.attendance-geofences.index');
    }

    public function create(Request $request){
        return view('backend.attendance-geofences.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'approval_required' => 'required',
            'sites' => 'required|array',
            'sites.*.name' => 'required',
            'sites.*.address' => 'required',
            'sites.*.radius' => 'required',
            'sites.*.latitude' => 'required',
            'sites.*.longitude' => 'required',  
        ]);
        
        $attendanceGeofence = new AttendanceGeofence();
        $attendanceGeofence->business_id = auth()->user()->getParentBusiness()->id;
        $attendanceGeofence->name = $request->name;
        $attendanceGeofence->approval_required = $request->approval_required;
        $attendanceGeofence->save();

        // Save sites
        foreach ($request->sites as $site) {
            $attendanceGeofence->sites()->create([
                'name' => $site['name'],
                'address' => $site['address'],
                'radius' => $site['radius'],
                'latitude' => $site['latitude'],
                'longitude' => $site['longitude'],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Attendance geofence created successfully',
            'redirect_url' => route('attendance-geofence.index')
        ]);
    }
    
    public function edit(Request $request, $id){
        $geofence = AttendanceGeofence::find($id);
        return view('backend.attendance-geofences.edit', compact('geofence'));
    }
    
    public function update(Request $request, $id){
        $geofence = AttendanceGeofence::find($id);
        $geofence->name = $request->name;
        $geofence->attendance_mode = $request->attendance_mode;
        $geofence->attendance_on_holiday = $request->attendance_on_holiday;
        $geofence->track_in_out_time = $request->track_in_out_time;
        $geofence->no_attendance_without_punch_out = $request->no_attendance_without_punch_out;
        $geofence->allow_multiple_punches = $request->allow_multiple_punches;
        $geofence->enable_auto_approval = $request->enable_auto_approval;
        $geofence->attendance_items = $request->attendance_items;
        $geofence->automation_items = $request->automation_items;
        $geofence->approval_days = $request->approval_days;
        $geofence->mark_absent_on_previous_days = $request->mark_absent_on_previous_days;
        $geofence->effective_working_hours = $request->effective_working_hours;
        $geofence->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Attendance geofence updated successfully',
            'redirect_url' => route('attendance-geofence.index')
        ]);
    }
    
    public function destroy(Request $request, $id){
        $geofence = AttendanceGeofence::find($id);
        $geofence->delete();
        
        return redirect()->route('backend.attendance-geofences.index')->with('success', 'Attendance geofence deleted successfully');
    }
}

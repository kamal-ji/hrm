<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AttendanceMode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AttendanceModeController  extends Controller
{
  public function index(Request $request)
    {
        if ($request->ajax()) {
            $attendanceModes = AttendanceMode::query();

            return DataTables::of($attendanceModes)
                ->addColumn('status', function ($mode) {
                    return $mode->is_active ? 'Active' : 'Inactive';
                })
                ->addColumn('actions', function ($mode) {
                    $editUrl = route('attendance-modes.edit', $mode->id);

                    $buttons = '<button class="btn btn-sm btn-primary editBtn" data-id="' . $mode->id . '">Edit</button> ';
                    $buttons .= '<button class="btn btn-sm btn-danger deleteBtn" data-id="' . $mode->id . '">Delete</button>';

                    return $buttons;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.attendancemode.index'); // Blade view
    }


    /**
     * Show the form for editing the specified attendance mode (JSON for modal).
     */
    public function edit($id)
    {
        $mode = AttendanceMode::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $mode
        ]);
    }

    /**
     * Store a newly created attendance mode.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'model_name' => 'required',
            'is_active' => 'required|boolean',
        ]);

        AttendanceMode::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Attendance Mode added successfully'
        ]);
    }

    /**
     * Update the specified attendance mode.
     */
    public function update(Request $request, AttendanceMode $attendanceMode)
    {
        $data = $request->validate([
            'model_name' => 'required',
            'is_active' => 'required|boolean',
        ]);

        $attendanceMode->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Attendance Mode updated successfully'
        ]);
    }

    /**
     * Delete the specified attendance mode.
     */
    public function destroy($id)
    {
        $mode = AttendanceMode::findOrFail($id);
        $mode->delete();

        return response()->json([
            'success' => true,
            'message' => 'Attendance Mode deleted successfully'
        ]);
    }
}
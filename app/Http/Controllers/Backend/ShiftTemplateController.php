<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Constants;
use App\Http\Controllers\Controller;
use App\Models\ShiftTemplate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ShiftTemplateController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $templates = ShiftTemplate::where('business_id', auth()->user()->getParentBusiness()->id);
            
            return datatables()->of($templates)
                ->editColumn('shift_type', function($template){
                    return Constants::getName('shift_type', $template->shift_type, '-');
                })
                ->addColumn('actions', function ($template) {
                    return view('backend.shift-templates.actions', compact('template'))->render();
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.shift-templates.index');
    }

    public function create(Request $request){
        return view('backend.shift-templates.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'shift_type' => [
                'required',
                Rule::in([
                    Constants::SHIFT_TYPE_FIXED,
                    Constants::SHIFT_TYPE_OPEN,
                    Constants::SHIFT_TYPE_ROTATIONAL,
                ])
            ],

            // Fixed Shift Fields
            'fixed_shift_code' => 'required_if:shift_type,fixed|nullable|string|max:255',
            'fixed_shift_start_time' => 'required_if:shift_type,fixed|nullable|string|max:255',
            'fixed_shift_end_time' => 'required_if:shift_type,fixed|nullable|string|max:255',
            'fixed_shift_buffer_start' => 'nullable|string|max:255',
            'fixed_shift_buffer_end' => 'nullable|string|max:255',

            // Fixed Shift Breaks
            'fixed_shift_breaks' => 'exclude_unless:shift_type,fixed|nullable|array',
            'fixed_shift_breaks.*.name' => 'required|string|max:255',
            'fixed_shift_breaks.*.pay_type' => 'required|string|in:paid,unpaid',
            'fixed_shift_breaks.*.type' => 'required|string|in:duration,interval',
            'fixed_shift_breaks.*.hours' => 'required_if:fixed_shift_breaks.*.type,duration|nullable|integer',
            'fixed_shift_breaks.*.minutes' => 'required_if:fixed_shift_breaks.*.type,duration|nullable|integer',
            'fixed_shift_breaks.*.interval_start' => 'required_if:fixed_shift_breaks.*.type,interval|nullable|string',
            'fixed_shift_breaks.*.interval_end' => 'required_if:fixed_shift_breaks.*.type,interval|nullable|string',

            // Open Shift Fields
            'open_shift_work_hour' => 'required_if:shift_type,open|nullable|integer',
            'open_shift_work_minute' => 'required_if:shift_type,open|nullable|integer',
            'open_shift_show_action_buttons' => 'nullable|boolean',

            // Rotational Shift Fields
            'rotational_shifts' => 'required_if:shift_type,rotational|nullable|array',
            'rotational_shifts.*.name' => 'required|string|max:255',
            'rotational_shifts.*.start_time' => 'required|string|max:255',
            'rotational_shifts.*.end_time' => 'required|string|max:255',
            'rotational_shifts.*.hours' => 'nullable|integer',
            'rotational_shifts.*.minutes' => 'nullable|integer',
        ]);
        
        $template = new ShiftTemplate();
        $template->business_id = auth()->user()->getParentBusiness()->id;
        $template->name = $request->name;
        $template->shift_type = $request->shift_type;
        $template->fixed_shift_code = $request->fixed_shift_code;
        $template->fixed_shift_start_time = $request->fixed_shift_start_time;
        $template->fixed_shift_end_time = $request->fixed_shift_end_time;
        $template->fixed_shift_buffer_start = $request->fixed_shift_buffer_start;
        $template->fixed_shift_buffer_end = $request->fixed_shift_buffer_end;
        $template->open_shift_work_hour_minute = $request->open_shift_work_hour . ':' . $request->open_shift_work_minute;
        $template->open_shift_show_action_buttons = $request->open_shift_show_action_buttons;
        $template->save();

        $template->fixedBreaks()->delete();
        if($template->shift_type == Constants::SHIFT_TYPE_FIXED){
            foreach($request->input('fixed_shift_breaks', []) as $fixed_shift_break){
                $template->fixedBreaks()->create([
                    'name' => $fixed_shift_break['name'],
                    'pay_type' => $fixed_shift_break['pay_type'],
                    'type' => $fixed_shift_break['type'],
                    'hour_minute' => ($fixed_shift_break['hours'] ?? '') . ':' . ($fixed_shift_break['minutes'] ?? ''),
                    'interval_start' => $fixed_shift_break['interval_start'] ?? '',
                    'interval_end' => $fixed_shift_break['interval_end'] ?? '',
                ]);
            }
        }

        $template->rotationalShifts()->delete();
        if($template->shift_type == Constants::SHIFT_TYPE_ROTATIONAL){
            foreach($request->input('rotational_shifts', []) as $rotational_shift){
                $template->fixedBreaks()->create([
                    'name' => $rotational_shift['name'],
                    'start_time' => $rotational_shift['start_time'],
                    'end_time' => $rotational_shift['end_time'],
                    'hour_minute' => ($rotational_shift['hours'] ?? '') . ':' . ($rotational_shift['minutes'] ?? ''),
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Shift template created successfully',
            'redirect_url' => route('shift-template.index')
        ]);
    }
    
    public function edit(Request $request, $id){
        $template = ShiftTemplate::find($id);
        return view('backend.shift-templates.edit', compact('template'));
    }
    
    public function update(Request $request, $id){
        $template = ShiftTemplate::find($id);

        if(!$template){
            return response()->json([
                'success' => false,
                'message' => 'Invalid Shift Template.'
            ]);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'shift_type' => [
                'required',
                Rule::in([
                    Constants::SHIFT_TYPE_FIXED,
                    Constants::SHIFT_TYPE_OPEN,
                    Constants::SHIFT_TYPE_ROTATIONAL,
                ])
            ],

            // Fixed Shift Fields
            'fixed_shift_code' => 'required_if:shift_type,fixed|nullable|string|max:255',
            'fixed_shift_start_time' => 'required_if:shift_type,fixed|nullable|string|max:255',
            'fixed_shift_end_time' => 'required_if:shift_type,fixed|nullable|string|max:255',
            'fixed_shift_buffer_start' => 'nullable|string|max:255',
            'fixed_shift_buffer_end' => 'nullable|string|max:255',

            // Fixed Shift Breaks
            'fixed_shift_breaks' => 'exclude_unless:shift_type,fixed|nullable|array',
            'fixed_shift_breaks.*.name' => 'required|string|max:255',
            'fixed_shift_breaks.*.pay_type' => 'required|string|in:paid,unpaid',
            'fixed_shift_breaks.*.type' => 'required|string|in:duration,interval',
            'fixed_shift_breaks.*.hours' => 'required_if:fixed_shift_breaks.*.type,duration|nullable|integer',
            'fixed_shift_breaks.*.minutes' => 'required_if:fixed_shift_breaks.*.type,duration|nullable|integer',
            'fixed_shift_breaks.*.interval_start' => 'required_if:fixed_shift_breaks.*.type,interval|nullable|string',
            'fixed_shift_breaks.*.interval_end' => 'required_if:fixed_shift_breaks.*.type,interval|nullable|string',

            // Open Shift Fields
            'open_shift_work_hour' => 'required_if:shift_type,open|nullable|integer',
            'open_shift_work_minute' => 'required_if:shift_type,open|nullable|integer',
            'open_shift_show_action_buttons' => 'nullable|boolean',

            // Rotational Shift Fields
            'rotational_shifts' => 'required_if:shift_type,rotational|nullable|array',
            'rotational_shifts.*.name' => 'required|string|max:255',
            'rotational_shifts.*.start_time' => 'required|string|max:255',
            'rotational_shifts.*.end_time' => 'required|string|max:255',
            'rotational_shifts.*.hours' => 'nullable|integer',
            'rotational_shifts.*.minutes' => 'nullable|integer',
        ]);
        
        $template->name = $request->name;
        $template->shift_type = $request->shift_type;
        $template->fixed_shift_code = $request->fixed_shift_code;
        $template->fixed_shift_start_time = $request->fixed_shift_start_time;
        $template->fixed_shift_end_time = $request->fixed_shift_end_time;
        $template->fixed_shift_buffer_start = $request->fixed_shift_buffer_start;
        $template->fixed_shift_buffer_end = $request->fixed_shift_buffer_end;
        $template->open_shift_work_hour_minute = $request->open_shift_work_hour . ':' . $request->open_shift_work_minute;
        $template->open_shift_show_action_buttons = $request->open_shift_show_action_buttons;
        $template->save();

        $template->fixedBreaks()->delete();
        if($template->shift_type == Constants::SHIFT_TYPE_FIXED){
            foreach($request->input('fixed_shift_breaks', []) as $fixed_shift_break){
                $template->fixedBreaks()->create([
                    'name' => $fixed_shift_break['name'],
                    'pay_type' => $fixed_shift_break['pay_type'],
                    'type' => $fixed_shift_break['type'],
                    'hour_minute' => ($fixed_shift_break['hours'] ?? '') . ':' . ($fixed_shift_break['minutes'] ?? ''),
                    'interval_start' => $fixed_shift_break['interval_start'] ?? '',
                    'interval_end' => $fixed_shift_break['interval_end'] ?? '',
                ]);
            }
        }

        $template->rotationalShifts()->delete();
        if($template->shift_type == Constants::SHIFT_TYPE_ROTATIONAL){
            foreach($request->input('rotational_shifts', []) as $rotational_shift){
                $template->fixedBreaks()->create([
                    'name' => $rotational_shift['name'],
                    'start_time' => $rotational_shift['start_time'],
                    'end_time' => $rotational_shift['end_time'],
                    'hour_minute' => ($rotational_shift['hours'] ?? '') . ':' . ($rotational_shift['minutes'] ?? ''),
                ]);
            }
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Shift template updated successfully',
            'redirect_url' => route('shift-template.index')
        ]);
    }
    
    public function destroy(Request $request, $id){
        $template = ShiftTemplate::find($id);

        if(!$template){
            return redirect()->route('backend.shift-templates.index')->with('error', 'Shift template not found.');
        }

        $template->fixedBreaks()->delete();
        $template->rotationalShifts()->delete();

        $template->delete();
        
        return redirect()->route('backend.shift-templates.index')->with('success', 'Shift template deleted successfully');
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HolidayTemplate;
use Illuminate\Http\Request;

class HolidayTemplateController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $templates = HolidayTemplate::where('business_id', auth()->user()->getParentBusiness()->id);
            
            return datatables()->of($templates)
                ->addColumn('actions', function ($template) {
                    return view('backend.holiday-templates.actions', compact('template'))->render();
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.holiday-templates.index');
    }

    public function create(Request $request){
        return view('backend.holiday-templates.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'year' => 'required',
            'holiday_dates' => 'required|array',
            'holiday_dates.*.date' => 'required|date',
            'holiday_dates.*.name' => 'required|string',
        ]);
        
        $template = new HolidayTemplate();
        $template->business_id = auth()->user()->getParentBusiness()->id;
        $template->name = $request->name;
        $template->selected_year = $request->year;
        $template->save();

        foreach ($request->holiday_dates as $holiday) {
            $template->dates()->create([
                'selected_date' => $holiday['date'],
                'name' => $holiday['name'],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Holiday template created successfully',
            'redirect_url' => route('holiday-template.index')
        ]);
    }
    
    public function edit(Request $request, $id){
        $template  = HolidayTemplate::findOrFail($id);
        return view('backend.holiday-templates.edit', compact('template'));
    }
    
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'year' => 'required',
            'holiday_dates' => 'required|array',
            'holiday_dates.*.date' => 'required|date',
            'holiday_dates.*.name' => 'required|string',
        ]);
        
        $template = HolidayTemplate::findOrFail($id);
        $template->name = $request->name;
        $template->selected_year = $request->year;
        $template->save();
        
        $template->dates()->delete();
        
        foreach ($request->holiday_dates as $holiday) {
            $template->dates()->create([
                'selected_date' => $holiday['date'],
                'name' => $holiday['name'],
            ]);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Holiday template updated successfully',
            'redirect_url' => route('holiday-template.index')
        ]);
    }
    
    public function destroy(Request $request, $id){
        $template = HolidayTemplate::findOrFail($id);
        $template->dates()->delete();
        $template->delete();
        
        return redirect()->route('backend.holiday-templates.index')->with('success', 'Holiday template deleted successfully');
    }
}

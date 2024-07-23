<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Hospital;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index( Request $request)
    {
        $hospitalId = $request->input('id_rumah_sakit');

        $hospitals = Hospital::all();

        $patients = Patient::when($hospitalId, function ($query, $hospitalId) {
            return $query->where('id_rumah_sakit', $hospitalId);
        })->get();

        if ($request->ajax()) {
            $html = view('patients.partials._table', compact('patients'))->render();
            return response()->json(['html' => $html]);
        }

        return view('patients.index', compact('patients', 'hospitals'));
    }


    public function create()
    {
        $hospitals = Hospital::all();
        return view('patients.create', compact('hospitals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'id_rumah_sakit' => 'required|exists:hospitals,id',
        ]);

        Patient::create($request->all());

        return redirect()->route('patients.index')
                         ->with('success', 'Patient created successfully.');
    }

    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        $hospitals = Hospital::all();
        return view('patients.edit', compact('patient', 'hospitals'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'id_rumah_sakit' => 'required|exists:hospitals,id',
        ]);

        $patient->update($request->all());

        return redirect()->route('patients.index')
                         ->with('success', 'Patient updated successfully.');
    }

    public function destroy($id)
    {
        $patient = Patient::find($id);
        if ($patient) {
            $patient->delete();
            return response()->json(['success' => 'Patient deleted successfully.']);
        } else {
            return response()->json(['error' => 'Patient not found.'], 404);
        }
    }
    public function filter(Request $request)
{
    $query = Patient::query();
    
    if ($request->filled('hospital_id')) {
        $query->where('id_rumah_sakit', $request->input('hospital_id'));
    }

    $patients = $query->with('hospital')->paginate(10);
    
    if ($request->ajax()) {
        return response()->json([
            'html' => view('patients.partials.patient_table', compact('patients'))->render(),
            'pagination' => view('patients.partials.pagination', compact('patients'))->render()
        ]);
    }

    return view('patients.index', compact('patients'));
}


}

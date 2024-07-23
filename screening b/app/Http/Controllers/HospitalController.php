<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::paginate(15);
        return view('hospitals.index', compact('hospitals'));
    }

    public function create()
    {
        return view('hospitals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_rumah_sakit' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
            'telepon' => 'required',
        ]);

        Hospital::create($request->all());

        return redirect()->route('hospitals.index')
                        ->with('success', 'Hospital created successfully.');
    }

    public function show(Hospital $hospital)
    {
        return view('hospitals.show', compact('hospital'));
    }

    public function edit(Hospital $hospital)
    {
        return view('hospitals.edit', compact('hospital'));
    }

    public function update(Request $request, Hospital $hospital)
    {
        $request->validate([
            'nama_rumah_sakit' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
            'telepon' => 'required',
        ]);

        $hospital->update($request->all());

        return redirect()->route('hospitals.index')
                        ->with('success', 'Hospital updated successfully.');
    }

    public function destroy(Hospital $hospital)
    {
        $hospital->delete();

        return response()->json(['success' => 'Hospital deleted successfully.']);
    }

}

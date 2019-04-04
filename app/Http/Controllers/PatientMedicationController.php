<?php

namespace App\Http\Controllers;

use App\Medication;
use App\PatientMedication;
use App\PatientMedicalRecordLog;
use App\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PatientMedicationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isDoctor']);           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $patient = Patient::where('id', $request->patientId)->first();

        $existingPatientMedication = PatientMedication::where('patientId', $request->id)->where('deleted_at', null)->get();

        $unsetMedication = Medication::whereNotIn('id', $existingPatientMedication->pluck('medicationId'))->get();

        return view('patient.medication.create', compact('patient', 'existingPatientMedication', 'unsetMedication'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'patientId' => 'required',
            'medicationId' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'quantity' => 'required',
            'notes' => 'required',
        ]); 
        
        $patientMedication = PatientMedication::create([
            'patientId' => $request->patientId,
            'medicationId' => $request->medicationId,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'quantity' => $request->quantity,
            'notes' => $request->notes
        ]);

        PatientMedicalRecordLog::create([
            'patientMedicationId' => $patientMedication->id,
            'doctorId' => Auth::id(),
            'type' => "Create",
            'patientId' => $request->patientId,
            'medicationId' => $request->medicationId,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'quantity' => $request->quantity,
            'notes' => $request->notes
        ]);

        flash('Patient medication record created.')->success();

        return redirect()->route('patient-medication.show', $request->patientId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::where('id', $id)->first();

        $existingPatientMedication = PatientMedication::where('patientId', $patient->id)->where('deleted_at', null)->get();

        return view('patient.medication.index', compact('patient', 'existingPatientMedication'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PatientMedication  $patientMedication
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientMedication $patientMedication)
    {
        $patient = Patient::where('id', $patientMedication->patientId)->first();

        return view('patient.medication.edit', compact('patient', 'patientMedication'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PatientMedication  $patientMedication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatientMedication $patientMedication)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'quantity' => 'required',
            'notes' => 'required',
        ]);
  
        $patientMedication->start_date = $request->start_date;
        $patientMedication->end_date = $request->end_date;
        $patientMedication->quantity = $request->quantity;
        $patientMedication->notes = $request->notes;
        $patientMedication->save();


        PatientMedicalRecordLog::create([
            'patientMedicationId' => $patientMedication->id,
            'doctorId' => Auth::id(),
            'type' => "Update",
            'patientId' => $patientMedication->patientId,
            'medicationId' => $patientMedication->medicationId,
            'start_date' => $patientMedication->start_date,
            'end_date' => $patientMedication->end_date,
            'quantity' => $patientMedication->quantity,
            'notes' => $patientMedication->notes
        ]);

        flash('Medication details successfully saved.')->success();
  
        return redirect()->route('patient-medication.show', $patientMedication->patientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PatientMedication  $patientMedication
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientMedication $patientMedication)
    {   
        PatientMedicalRecordLog::create([
            'patientMedicationId' => $patientMedication->id,
            'doctorId' => Auth::id(),
            'type' => "Delete",
            'patientId' => $patientMedication->patientId,
            'medicationId' => $patientMedication->medicationId,
            'start_date' => $patientMedication->start_date,
            'end_date' => $patientMedication->end_date,
            'quantity' => $patientMedication->quantity,
            'notes' => $patientMedication->notes
        ]);

        $patientMedication->delete();

        flash('Medication has been removed from patient.')->success();

        return redirect()->route('patient-medication.show', $patientMedication->patientId);
    }
}

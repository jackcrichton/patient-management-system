<?php

namespace App\Http\Controllers;

use App\Allergy;
use App\Patient;
use App\PatientAllergy;
use App\PatientAllergyRecordLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PatientAllergyController extends Controller
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

        $existingPatientAllergies = PatientAllergy::where('patientId', $request->patientId)->where('deleted_at', null)->get();

        $unsetAllergies = Allergy::whereNotIn('id', $existingPatientAllergies->pluck('allergyId'))->get();

        $severity = ['Mild', 'Moderate', 'Severe'];

        $sourceOfInfo = ['Practise reported', 'Patient reported', 'Allergy history', 'Transition of care/referral'];

        $status = ['Active', 'Inactive', 'Resolved'];

        return view('patient.allergies.create', compact('unsetAllergies', 'patient', 'severity', 'sourceOfInfo', 'status'));
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
            'allergyId' => 'required',
            'reactionSeverity' => 'required',
            'reaction' => 'required',
            'sourceOfInfo' => 'required',
            'status' => 'required',
        ]); 
        
        $patientAllergy = PatientAllergy::create([
            'patientId' => $request->patientId,
            'allergyId' => $request->allergyId,
            'reactionSeverity' => $request->reactionSeverity,
            'reaction' => $request->reaction,
            'sourceOfInfo' => $request->sourceOfInfo,
            'status' => $request->status
        ]);

        PatientAllergyRecordLog::create([
            'patientAllergyId' => $patientAllergy->id,
            'doctorId' => Auth::id(),
            'type' => "Create",
            'patientId' => $request->patientId,
            'allergyId' => $request->allergyId,
            'reactionSeverity' => $request->reactionSeverity,
            'reaction' => $request->reaction,
            'sourceOfInfo' => $request->sourceOfInfo,
            'status' => $request->status
        ]);

        flash('Patient allergy record created.')->success();

        return redirect()->route('patient-allergies.show', $request->patientId);
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

        $existingPatientAllergies = PatientAllergy::where('patientId', $id)->get();

        return view('patient.allergies.index', compact('patient', 'existingPatientAllergies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PatientAllergy  $patientAllergy
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientAllergy $patientAllergy)
    {
        $patient = Patient::where('id', $patientAllergy->patientId)->first();

        $severity = ['Mild', 'Moderate', 'Severe'];

        $sourceOfInfo = ['Practise reported', 'Patient reported', 'Allergy history', 'Transition of care/referral'];

        $status = ['Active', 'Inactive', 'Resolved'];

        return view('patient.allergies.edit', compact('patient', 'severity', 'patientAllergy', 'sourceOfInfo', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PatientAllergy  $patientAllergy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatientAllergy $patientAllergy)
    {
        $request->validate([
            'reactionSeverity' => 'required',
            'reaction' => 'required',
            'sourceOfInfo' => 'required',
            'status' => 'required',
        ]);
  
        $patientAllergy->reactionSeverity = $request->reactionSeverity;
        $patientAllergy->reaction = $request->reaction;
        $patientAllergy->sourceOfInfo = $request->sourceOfInfo;
        $patientAllergy->status = $request->status;
        $patientAllergy->save();

        PatientAllergyRecordLog::create([
            'patientAllergyId' => $patientAllergy->id,
            'doctorId' => Auth::id(),
            'type' => "Update",
            'patientId' => $patientAllergy->patientId,
            'allergyId' => $patientAllergy->allergyId,
            'reactionSeverity' => $patientAllergy->reactionSeverity,
            'reaction' => $patientAllergy->reaction,
            'sourceOfInfo' => $patientAllergy->sourceOfInfo,
            'status' => $patientAllergy->status
        ]);

        flash('Allergy details successfully saved.')->success();
  
        return redirect()->route('patient-allergies.show', $patientAllergy->patientId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PatientAllergy  $patientAllergy
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientAllergy $patientAllergy)
    {

        PatientAllergyRecordLog::create([
            'patientAllergyId' => $patientAllergy->id,
            'doctorId' => Auth::id(),
            'type' => "Delete",
            'patientId' => $patientAllergy->patientId,
            'allergyId' => $patientAllergy->allergyId,
            'reactionSeverity' => $patientAllergy->reactionSeverity,
            'reaction' => $patientAllergy->reaction,
            'sourceOfInfo' => $patientAllergy->sourceOfInfo,
            'status' => $patientAllergy->status
        ]);

        $patientAllergy->delete();

        flash('Allergy has been removed from patient.')->success();

        return redirect()->route('patient-allergies.show', $patientAllergy->patientId);
    }
}

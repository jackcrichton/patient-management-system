<?php

namespace App\Http\Controllers;

use App\Patient;
use App\PatientAllergyRecordLog;
use App\PatientMedicalRecordLog;
use Illuminate\Http\Request;

class PatientHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isDoctor']);           
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

        $patientAllergyRecordLogs = PatientAllergyRecordLog::where('patientId', $patient->id)->get();
        $patientMedicalRecordLogs = PatientMedicalRecordLog::where('patientId', $patient->id)->get();

        $historyLog = array();

        foreach($patientAllergyRecordLogs as $p) {
            $historyLog[] = $p;
        }

        foreach($patientMedicalRecordLogs as $p) {
            $historyLog[] = $p;
        }

        $historyLog = collect($historyLog)->sortByDesc('created_at')->all();

        return view('patient.history.index', compact('patient', 'historyLog'));
    }
}

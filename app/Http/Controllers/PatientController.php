<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Patient;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isDoctor']);           
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();    

        $newRequest = null;

        $myPatients = Patient::where('userAssignedTo', Auth::id())
            ->get();

        $allPatients = Patient::whereNotIn('id', $myPatients->pluck('id'))
            ->paginate('10');

        if($request->has('reset')) {            
            return redirect()->route('patient.index');
        } elseif ($request->has('search')) {
            $newRequest = $request;

            $user = Auth::user();

            $myPatients = Patient::where('userAssignedTo', Auth::id())
                ->where('forename', 'LIKE', '%'.$request->forename.'%')
                ->where('surname', 'LIKE', '%'.$request->surname.'%')
                ->where('dateOfBirth', 'LIKE', '%'.$request->dateOfBirth.'%')
                ->where('postcode', 'LIKE', '%'.$request->postcode.'%')
                ->paginate('10');

            $allPatients = Patient::where('forename', 'LIKE', '%'.$request->forename.'%')
                ->whereNotIn('id', $myPatients->pluck('id'))
                ->where('surname', 'LIKE', '%'.$request->surname.'%')
                ->where('dateOfBirth', 'LIKE', '%'.$request->dateOfBirth.'%')
                ->where('postcode', 'LIKE', '%'.$request->postcode.'%')
                ->paginate('10');

            return view('doctor.index', compact('user', 'allPatients', 'myPatients', 'newRequest'));
        }

        return view('doctor.index', compact('user', 'allPatients', 'myPatients', 'newRequest')); 
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

        return view('patient.personal.index', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::where('id', $id)->first();

        $titles = ['Dr', 'Mr', 'Mrs', 'Miss', 'Ms'];

        $sex = ['male', 'female', 'other'];

        return view('patient.personal.edit', compact('patient', 'titles', 'sex'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $patient = Patient::where('id', $id)->first();

        $request->validate([
            'title' => 'required',
            'forename' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'dateOfBirth' => 'required',
            'sex' => 'required',
            'firstLineAddress' => 'required',
            'town' => 'required',
            'country' => 'required',
            'mobileNo' => 'required',
            'postcode' => 'required'
        ]);
  
        $patient->title = $request->title;
        $patient->forename = $request->forename;
        $patient->surname = $request->surname;
        $patient->email = $request->email;
        $patient->dateOfBirth = $request->dateOfBirth;
        $patient->sex = $request->sex;
        $patient->firstLineAddress = $request->firstLineAddress;
        $patient->town = $request->town;
        $patient->country = $request->country;
        $patient->mobileNo = $request->mobileNo;
        $patient->postcode = $request->postcode;
        $patient->save();

       flash('Patient details updated.')->success();

        return redirect()->route('patient.show', $id);
    }
}

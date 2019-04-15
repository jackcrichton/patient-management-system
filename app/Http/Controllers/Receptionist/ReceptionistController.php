<?php

namespace App\Http\Controllers\Receptionist;

use App\User;
use App\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReceptionistController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isReceptionist']);           
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

        $allPatients = Patient::orderBy('created_at', 'desc')->paginate('10');

        if($request->has('reset')) {            
            return redirect()->route('receptionist.index');
        } elseif ($request->has('search')) {
            $newRequest = $request;

            $allPatients = Patient::where('forename', 'LIKE', '%'.$request->forename.'%')
                ->where('surname', 'LIKE', '%'.$request->surname.'%')
                ->where('dateOfBirth', 'LIKE', '%'.$request->dateOfBirth.'%')
                ->where('postcode', 'LIKE', '%'.$request->postcode.'%')
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('receptionist.index', compact('user', 'allPatients', 'newRequest'));
        }

        return view('receptionist.index', compact('user', 'allPatients', 'newRequest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $titles = ['Dr', 'Mr', 'Mrs', 'Miss', 'Ms'];

        $sex = ['male', 'female', 'other'];

        $doctors = User::where('role', 'doctor')->get();

        return view('receptionist.create', compact('titles', 'sex', 'doctors'));
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
            'title' => 'required|max:255',
            'forename' => 'required|max:255',
            'surname' => 'required|max:255',
            'dateOfBirth' => 'date|before:today',
            'sex' => 'required',
            'firstLineAddress' => 'required',
            'town' => 'required',
            'country' => 'required',
            'postcode' => 'required',
            'mobileNo' => 'required',
            'email' => 'required|string|email|max:255',
            'userAssignedTo' => 'required',
        ]); 

        $patient = Patient::create([
            'title' =>  $request->title,
            'forename' => $request->forename,
            'surname' => $request->surname,
            'dateOfBirth' => $request->dateOfBirth,
            'sex' => $request->sex,
            'firstLineAddress' => $request->firstLineAddress,
            'town' => $request->town,
            'country' => $request->country,
            'postcode' => $request->postcode,
            'mobileNo' => $request->mobileNo,
            'email' => $request->email,
            'userAssignedTo' => $request->userAssignedTo,
        ]);

        flash('Patient record created and assigned to a doctor.')->success();

        $user = Auth::user();   
    
        return redirect()->route('receptionist.show', $patient->id);
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
        
        $doctor = User::where('role', 'doctor')->where('id', $patient->userAssignedTo)->first();

        return view('receptionist.show', compact('patient', 'doctor'));
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

        $doctors = User::where('role', 'doctor')->get();

        $currentDoctor = User::where('role', 'doctor')->where('id', $patient->userAssignedTo)->first();

        return view('receptionist.edit', compact('patient', 'titles', 'sex', 'doctors', 'currentDoctor'));
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
            'postcode' => 'required',
            'userAssignedTo' => 'required'
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
        $patient->userAssignedTo = $request->userAssignedTo;
        $patient->save();

        flash('Patient details updated.')->success();

        return redirect()->route('receptionist.show', $patient->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Patient::where('id', $id)->delete();

        flash('Patient has been successfully removed from the system.')->success();

        return redirect()->route('receptionist.index');
    }
}

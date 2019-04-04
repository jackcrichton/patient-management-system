<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $titles = ['Dr', 'Mr', 'Mrs', 'Miss', 'Ms'];

        return view('doctor.create', compact('titles'));
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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'title' =>  $request->title,
            'forename' => $request->forename,
            'surname' => $request->surname,
            'dateOfBirth' => $request->dateOfBirth,
            'email' => $request->email,
            'password' => $request->password,
            'active' => true,
            'role' => 'doctor',
        ]);

        flash('Doctor account created.')->success();

        return redirect('admin');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $titles = ['Dr', 'Mr', 'Mrs', 'Miss', 'Ms'];

        $doctor = User::where('id', $id)->first();

        return view('doctor.edit', compact('doctor', 'titles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $doctor = User::where('id', $id)->first();

        $request->validate([
            'title' => 'required',
            'forename' => 'required',
            'surname' => 'required',
            'dateOfBirth' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
  
        $doctor->title = $request->title;
        $doctor->forename = $request->forename;
        $doctor->surname = $request->surname;
        $doctor->dateOfBirth = $request->dateOfBirth;
        $doctor->email = $request->email;
        $doctor->password = $request->password;
        $doctor->save();

        flash('Doctor details updated.')->success();
  
        return redirect()->action('Admin\AdminController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();

        flash('User has been successfully removed from the system.')->success();

        return redirect()->action('Admin\AdminController@index');
    }
}

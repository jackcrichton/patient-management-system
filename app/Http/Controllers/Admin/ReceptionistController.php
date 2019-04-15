<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReceptionistController extends Controller
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

        return view('admin.receptionist.create', compact('titles'));
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
            'password' => 'required|string|min:6|confirmed',
        ]);

        try{
        
        $user = User::create([
            'title' =>  $request->title,
            'forename' => $request->forename,
            'surname' => $request->surname,
            'dateOfBirth' => $request->dateOfBirth,
            'email' => $request->email,
            'password' => $request->password,
            'active' => true,
            'role' => 'receptionist',
        ]);

        flash('Receptionist account created.')->success();

        return redirect('admin');
                        
        }
            catch(\Illuminate\Database\QueryException $e) {
                
                if($e->getCode() == '23000'){
                   flash("Email already exists. Please try again")->error();
                }

                if($e->getCode() == '22007'){
                    flash("Date format incorrect. Please try again using (YYYY-MM-DD).")->error();
                }

            return redirect()->route('admin.index');
        }
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

        $receptionist = User::where('id', $id)->first();

        return view('admin.receptionist.edit', compact('receptionist', 'titles'));
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
        $receptionist = User::where('id', $id)->first();

        $request->validate([
            'title' => 'required|max:255',
            'forename' => 'required|max:255',
            'surname' => 'required|max:255',
            'dateOfBirth' => 'date|before:today',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
      
        try{

	        $receptionist->title = $request->title;
	        $receptionist->forename = $request->forename;
	        $receptionist->surname = $request->surname;
	        $receptionist->dateOfBirth = $request->dateOfBirth;
	        $receptionist->email = $request->email;
	        $receptionist->password = $request->password;
	        $receptionist->save();

	        flash('Receptionist details updated.')->success();
	  
	        return redirect()->action('Admin\AdminController@index');

        } catch(\Illuminate\Database\QueryException $e) {
                
           if($e->getCode() == '23000'){
               flash("Email already exists. Please try again")->error();
           }
            if($e->getCode() == '22007'){
               flash("Date format incorrect. Please try again using (YYYY-MM-DD).")->error();
           }
            return redirect()->route('admin.index');
        }
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

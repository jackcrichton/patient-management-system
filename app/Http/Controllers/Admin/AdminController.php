<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);      
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        
        $adminUsers = [];

        if($user->role == 'superadmin')
        {
            $adminUsers = User::where('role', 'admin')->orderBy('created_at', 'desc')->get(); 
        }
        
        $doctors = User::where('role', 'doctor')->orderBy('created_at', 'desc')->paginate(10); 

        return view('admin.index', compact('user', 'adminUsers', 'doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $titles = ['Dr', 'Mr', 'Mrs', 'Miss', 'Ms'];

        return view('admin.create', compact('titles'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function store(Request $request)
    {    
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'forename' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'dateOfBirth' => 'date|before:today',
            'password' => 'required|string|min:6|confirmed',
            
        ]); 

        $admin = User::create([
            'title' =>  $request->title,
            'forename' => $request->forename,
            'surname' => $request->surname,
            'email' => $request->email,
            'dateOfBirth' => $request->dateOfBirth,
            'password' => $request->password,
            'active' => true,
            'role' => 'admin',
        ]);

        flash('Admin account created.')->success();

        return redirect('admin');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $titles = ['Dr', 'Mr', 'Mrs', 'Miss', 'Ms'];

        $admin = User::where('id', $id)->first();

        return view('admin.edit', compact('admin', 'titles'));
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
        $admin = User::where('id', $id)->first();

        $request->validate([
            'title' => 'required',
            'forename' => 'required',
            'surname' => 'required',
            'dateOfBirth' => 'required',
            'email' => 'required',
            'password' => 'required|string|min:6|confirmed',

        ]);
  
        $admin->title = $request->title;
        $admin->forename = $request->forename;
        $admin->surname = $request->surname;
        $admin->dateOfBirth = $request->dateOfBirth;
        $admin->email = $request->email;
        $admin->password = $request->password;
        $admin->save();

        flash('Admin details updated.')->success();
  
        return redirect()->route('admin.index');
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

        return redirect()->route('admin.index');
    }
}

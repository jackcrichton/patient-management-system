<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
  	public function run()
    {
        DB::table('users')->insert([
	    	[
	    		'id' => 11111,
	            'title' => 'Mr',
	        	'forename' => 'Example',
	            'surname' => 'Superadmin',
	        	'email' => 'superadmin@pms.com',
	        	'dateOfBirth' => '1997/05/13',
	        	'password' => bcrypt('ko'),
	        	'active' => 1,
	        	'role' => 'superadmin',
	        ],

           	[
	    		'id' => 11112,
	            'title' => 'Mr',
	        	'forename' => 'Example',
	            'surname' => 'Admin',
	        	'email' => 'admin@pms.com',
	        	'dateOfBirth' => '1997/05/13',
	        	'password' => bcrypt('ko'),
	        	'active' => 1,
	        	'role' => 'admin',
	        ],

	        [
	        	'id' => 11113,
		        'title' => 'Mr',
	     		'forename' => 'Example',
	            'surname' => 'Doctor',
	        	'email' => 'doctor@pms.com',
	        	'dateOfBirth' => '1996/05/11',
	        	'password' => bcrypt('ko'),
	        	'active' => 1,
	        	'role' => 'doctor',
	        ],

	        [
	        	'id' => 11114,
		        'title' => 'Mrs',
	     		'forename' => 'Example',
	            'surname' => 'Nurse',
	        	'email' => 'nurse@pms.com',
	        	'dateOfBirth' => '1996/05/11',
	        	'password' => bcrypt('ko'),
	        	'active' => 1,
	        	'role' => 'nurse',
	        ],

	        [
	        	'id' => 11115,
	            'title' => 'Mr',
	       		'forename' => 'Example',
	            'surname' => 'Receptionist',
	        	'email' => 'receptionist@pms.com',
	        	'dateOfBirth' => '1996/05/11',
	        	'password' => bcrypt('ko'),
	        	'active' => 1,
	        	'role' => 'receptionist',
	        ]
	    ]);

        factory(App\User::class, 5)->create();     
    }  
}

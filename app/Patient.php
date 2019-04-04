<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
	use softDeletes;

	protected $table = 'patients';

    public $fillable = [
    	'title', 'forename', 'surname', 'dateOfBirth', 'gender', 'firstLineAddress', 'town', 'country', 'postcode', 'mobileNo', 'email', 'userAssignedTo'
	];

	public function doctor()
	{
		return User::where('role', 'doctor')->where('id', $this->userAssignedTo)->first();
	}
}

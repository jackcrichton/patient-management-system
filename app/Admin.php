<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
	use softDeletes;
	
    protected $fillable = ['title', 'forename', 'surname', 'email', 'dateOfBirth', 'password', 'active', 'role'];
}

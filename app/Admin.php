<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = ['title', 'forename', 'surname', 'email', 'dateOfBirth', 'password', 'active', 'role'];
}

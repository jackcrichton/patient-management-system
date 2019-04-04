<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientAllergyRecordLog extends Model
{
    public $fillable = ['patientAllergyId', 'doctorId', 'type', 'patientId', 'allergyId', 'reactionSeverity', 'reaction', 'sourceOfInfo', 'status'];

    public function allergy()
    {
		return Allergy::where('id', $this->allergyId)->first();
    }

    public function doctor()
    {
    	return User::where('role', 'doctor')->where('id', $this->doctorId)->first();
    }
}

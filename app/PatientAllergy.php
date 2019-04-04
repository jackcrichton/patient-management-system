<?php

namespace App;
use App\Allergy;
use App\Patient;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PatientAllergy extends Model
{
	use softDeletes;

    public $fillable = ['patientId', 'allergyId', 'reactionSeverity', 'reaction', 'sourceOfInfo', 'status'];

    public function allergy()
    {
		return Allergy::where('id', $this->allergyId)->first();
    }

    public function patient()
    {
		return Patient::where('id', $this->patientId)->first();
    }
}

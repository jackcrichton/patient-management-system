<?php

namespace App;

use App\Medication;
use App\Patient;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PatientMedication extends Model
{
	use softDeletes;

    public $fillable = ['patientId', 'medicationId', 'start_date', 'end_date', 'quantity', 'notes'];

    public function medication()
    {
		return Medication::where('id', $this->medicationId)->first();
    }

    public function patient()
    {
		return Patient::where('id', $this->patientId)->first();
    }
}

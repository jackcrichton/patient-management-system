<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class patientMedicalRecordLog extends Model
{
    public $fillable = ['patientMedicationId', 'doctorId', 'type', 'patientId', 'medicationId', 'start_date', 'end_date', 'quantity', 'notes'];

    public function medication()
    {
		return Medication::where('id', $this->medicationId)->first();
    }

    public function doctor()
    {
    	return User::where('role', 'doctor')->where('id', $this->doctorId)->first();
    }
}

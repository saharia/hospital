<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorSpeciality extends Model
{
    protected $fillable = [
        'doctor_id',
        'speciality_id'
    ];

    /**
     * Get the Speciality record associated with the doctor.
     */
    public function Doctor()
    {
        return $this->belongsTo('App\Doctor');
    }

    /**
     * Get the Speciality record associated with the doctor.
     */
    public function Speciality()
    {
        return $this->belongsTo('App\Speciality');
    }
}

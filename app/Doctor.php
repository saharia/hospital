<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    //
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'city',
        'country',
        'job_title'       
    ];

    /**
     * Get the Speciality record associated with the doctor.
     */
    public function Specialities()
    {
        return $this->hasMany('App\DoctorSpeciality', 'doctor_id', 'id');
    }

    /*public function getSpecialitiesAttribute()
	{
	    return $this->Specialities->Speciality->pluck('name')->implode(',');
	}*/
}

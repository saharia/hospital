<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
   protected $fillable = [
        'name'
    ];

    /**
     * Get the Speciality record associated with the doctor.
     */
    public function Doctors()
    {
        return $this->belongsToMany('App\Doctor')->using('App\DoctorSpeciality');
    }
}

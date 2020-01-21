<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use App\Speciality;
use App\DoctorSpeciality;
use Carbon\Carbon;
class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::all();

        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialities = Speciality::all();
        return view('doctors.create', compact('specialities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'job_title'=>'required',
            'city'=>'required',
            'country'=>'required',
        ]);

        $doctor = new Doctor([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'job_title' => $request->get('job_title'),
            'city' => $request->get('city'),
            'country' => $request->get('country')
        ]);
        $specialities = $request->get('specialities');
        $doctor->save();
        $doctor_id = $doctor->id;
        $now = Carbon::now('utc')->toDateTimeString();
        $data = [];
        foreach ($specialities as $speciality) {
            $data[] = [ 'speciality_id' => $speciality, 'doctor_id' => $doctor_id, 'created_at'=> $now, 'updated_at'=> $now ];
        }
        if(count($data)) {
            DoctorSpeciality::insert($data);
        }
        return redirect('/doctor')->with('success', 'Data saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $specialities = Speciality::all();
        $doctor = Doctor::find($id);
        $speciality_ids = $doctor->Specialities()->pluck('speciality_id')->toArray();
        // dd($speciality_ids);
        return view('doctors.edit', compact('doctor', 'specialities', 'speciality_ids'));     
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required'
        ]);

        $doctor = Doctor::find($id);
        $doctor->first_name =  $request->get('first_name');
        $doctor->last_name = $request->get('last_name');
        $doctor->email = $request->get('email');
        $doctor->job_title = $request->get('job_title');
        $doctor->city = $request->get('city');
        $doctor->country = $request->get('country');
        $doctor->save();

        $doctor_id = $doctor->id;
        $now = Carbon::now('utc')->toDateTimeString();
        $data = [];
        $specialities = $request->get('specialities');
        DoctorSpeciality::where([ 'doctor_id' => $doctor_id ])->delete();
        foreach ($specialities as $speciality) {
            $data[] = [ 'speciality_id' => $speciality, 'doctor_id' => $doctor_id, 'created_at'=> $now, 'updated_at'=> $now ];
        }
        if(count($data)) {
            DoctorSpeciality::insert($data);
        }
        return redirect('/doctor')->with('success', 'doctor updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        $doctor->delete();
        DoctorSpeciality::where([ 'doctor_id' => $id ])->delete();
        return redirect('/doctor')->with('success', 'doctor deleted!');
    }
}

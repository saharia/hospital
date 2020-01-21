@extends('adminlte::page')

@section('title', 'Doctors')

@section('content_header')
    <h1>Doctors</h1>
@stop

@section('content')
<div class="row">
<div class="col-sm-12">
  <div class="col-sm-12">

  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div>
  @endif
</div>
  <div class="col-sm-12 pull-right">
    <a style="" href="{{ route('doctor.create')}}" class="btn btn-primary pull-right">New doctor</a>
    </div>  
    <h1 class="display-3">Doctors</h1>    
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Name</td>
          <td>Email</td>
          <td>Job Title</td>
          <td>City</td>
          <td>Country</td>
          <td>Specialiies</td>
          <td colspan = 2>Actions</td>
        </tr>
    </thead>
    <tbody>
        @foreach($doctors as $doctor)
        <tr>
            <td>{{$doctor->id}}</td>
            <td>{{$doctor->first_name}} {{$doctor->last_name}}</td>
            <td>{{$doctor->email}}</td>
            <td>{{$doctor->job_title}}</td>
            <td>{{$doctor->city}}</td>
            <td>{{$doctor->country}}</td>
            <td>
                <a href="{{ route('doctor.edit',$doctor->id)}}" class="btn btn-primary">Edit</a>
            </td>
            <td>
                <form action="{{ route('doctor.destroy', $doctor->id)}}" method="post" onsubmit="return confirm('Are you sure to remove?');">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit" >Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
</div>
@endsection
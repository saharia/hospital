@extends('adminlte::page')

@section('title', 'Specialities')

@section('content_header')
    <h1>Specialities</h1>
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
    <a style="" href="{{ route('specialities.create')}}" class="btn btn-primary pull-right">New Speciality</a>
    </div>  
    <h1 class="display-3">Specialities</h1>    
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Name</td>
          <td colspan = 2>Actions</td>
        </tr>
    </thead>
    <tbody>
        @foreach($specialities as $speciality)
        <tr>
            <td>{{$speciality->id}}</td>
            <td>{{$speciality->name}}</td>
            <td>
                <a href="{{ route('specialities.edit',$speciality->id)}}" class="btn btn-primary">Edit</a>
            </td>
            <td>
                <form action="{{ route('specialities.destroy', $speciality->id)}}" method="post" onsubmit="return confirm('Are you sure to remove?');">
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
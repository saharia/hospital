@extends('adminlte::page')

@section('title', 'Create Speciality')

@section('content_header')
    <h1>Create Speciality</h1>
@stop

@section('content')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Add a doctor</h1>
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('specialities.store') }}">
          @csrf
          <div class="form-group">    
              <label for="name">Name:</label>
              <input type="text" class="form-control" name="name"/>
          </div>

          <button type="submit" class="btn btn-primary">Add Speciality</button>
      </form>
  </div>
</div>
</div>
@endsection
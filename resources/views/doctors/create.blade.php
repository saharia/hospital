@extends('adminlte::page')

@section('title', 'Create Doctor')

@section('content_header')
    <h1>Create Doctor</h1>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
    <style type="text/css">
      .select2-container {
        width: 100% !important;
      }
      ul.select2-selection__rendered li {
        color: #000 !important;
      }
    </style>
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
      <form method="post" action="{{ route('doctor.store') }}">
          @csrf
          <div class="form-group">    
              <label for="first_name">First Name:</label>
              <input type="text" class="form-control" name="first_name"/>
          </div>

          <div class="form-group">
              <label for="last_name">Last Name:</label>
              <input type="text" class="form-control" name="last_name"/>
          </div>

          <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" class="form-control" name="email"/>
          </div>
          <div class="form-group">
              <label for="city">City:</label>
              <input type="text" class="form-control" name="city"/>
          </div>
          <div class="form-group">
              <label for="country">Country:</label>
              <input type="text" class="form-control" name="country"/>
          </div>
          <div class="form-group">
              <label for="job_title">Job Title:</label>
              <input type="text" class="form-control" name="job_title"/>
          </div>  
          <div class="form-group">
              <label for="job_title">Specialities</label>
              <select name="specialities[]" multiple class="select2" class="form-control col-sm-12" >
                @foreach($specialities as $speciality)
                  <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                @endforeach
              </select>
          </div>                           
          <button type="submit" class="btn btn-primary">Add doctor</button>
      </form>
  </div>
</div>
</div>
@endsection

@section('js')
    <script src="{{ asset('vendor/select2/js/select2.full.min.js') }}"> </script>
    <script type="text/javascript">
      $(document).ready(function() {
        $(".select2").select2();
      });
    </script>
@stop
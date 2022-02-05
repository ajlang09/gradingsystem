@extends('layouts.app')

@section('content')
<form action="{{ route('classes.store') }}" method="post">
@csrf
<div class="row">
    <div class="col-md-6 offset-md-3 col-sm-12">
      <div class="card mt-5">
          <div class="card-body">
            <h5 class="card-title">CLASS FORM</h5>
            <hr>
            <div class="row">
                <div class="col-sm-12 mb-1">
                    <label class="mb-1" for="class_name">Class Name</label>
                    <br>
                    <input type="text" name="class_name" id="class_name" placeholder="" 
                    class="form-control">
                </div>
                <div class="col-sm-12 mb-1">
                    <label class="mb-1" for="year">Year</label>
                    <br>
                    <input type="text" name="year" id="year" placeholder="" 
                    class="form-control">
                </div>
                <div class="col-sm-12 mb-1">
                    <label class="mb-1" for="semester">Semester</label>
                    <br>
                    <select class="form-control" name="semester" id="semester" required>
                      <option value="first-semester">1st semester</option>
                      <option value="second-semester">2nd semester</option>
                    </select>
                </div>
                  <div class="col-sm-12 mb-1 mt-2">
                      <button type="submit" class="btn btn-primary">Add Class</button>
                  </div>
            </div>
          </div>
      </div>
  </div>
</form>
@endsection
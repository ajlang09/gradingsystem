@extends('layouts.app')

@section('content')
<form action="{{ route('classes.update') }}" method="post">
@csrf
<div class="row">
    <div class="col-md-6 offset-md-3 col-sm-12">
      <div class="card mt-5">
          <div class="card-body">
            <h5 class="card-title">ENROLLING FORM</h5>
            <hr>
            <div class="row">
                <input type="hidden" name="class_id" value="{{$data->class_id}}">
                <div class="col-sm-12 mb-1">
                    <label class="mb-1" for="class_name">Class Name</label>
                    <br>
                    <input type="text" name="class_name" id="class_name" value="{{$data->class_name}}"
                    class="form-control">
                </div>

                <div class="col-sm-12 mb-1">
                    <label class="mb-1" for="password">Enroll student(student no.)</label>
                    <input type="id" name="" id="" value=""
                    class="form-control">
                </div>

                  <div class="col-sm-12 mb-1 mt-2">
                      <button type="submit" class="btn btn-primary">UPDATE</button>
                  </div>
            </div>
          </div>
      </div>
  </div>
</form>
@endsection
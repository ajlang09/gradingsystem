@extends('layouts.app')

@section('content')
<form action="{{ route('student.update') }}" method="post">
@csrf
<div class="row">
    <div class="col-md-6 offset-md-3 col-sm-12">
      <div class="card mt-5">
          <div class="card-body">
            <h5 class="card-title">STUDENT FORM</h5>
            <hr>
            <div class="row">
                <input type="hidden" name="id" value="{{$data->id}}">
                <div class="col-sm-12 mb-1">
                    <label class="mb-1" for="email">Name</label>
                    <br>
                    <input type="text" name="name" id="name" value="{{$data->name}}"
                    class="form-control">
                </div>

                <div class="col-sm-12 mb-1">
                    <label class="mb-1" for="password">Year and Section</label>
                    <input type="yearandsection" name="yearandsection" id="yearandsection" value="{{$data->yearandsection}}"
                    class="form-control">
                </div>

                  <div class="col-sm-12 mb-1">
                      <label class="mb-1" for="email">Student ID</label>
                      <br>
                      <input type="stud_id" name="stud_id" id="stud_id" value="{{$data->stud_id}}"
                      class="form-control">
                  </div>

                  <div class="col-sm-12 mb-1">
                      <label class="mb-1" for="password">Email</label>
                      <input type="email" name="email" id="email" value="{{$data->email}}"
                      class="form-control">
                  </div>

                 <div class="col-sm-12 mb-1">
                    <label class="mb-1" for="password">Contact No.</label>
                    <input type="contact_no" name="contact_no" id="contact_no" value="{{$data->contact_no}}"
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
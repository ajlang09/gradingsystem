@extends('layouts.app')

@section('content')
<form action="{{ route('student.store') }}" method="post">
@csrf
<div class="row">
    <div class="col-md-6 offset-md-3 col-sm-12">
      <div class="card mt-5">
          <div class="card-body">
            <h5 class="card-title">STUDENT FORM</h5>
            <hr>
            <div class="row">
                <div class="col-sm-12 mb-1">
                    <label class="mb-1" for="email">Name</label>
                    <br>
                    <input type="text" name="name" id="name" placeholder=""  required
                    class="form-control">
                </div>

                <div class="col-sm-12 mb-1">
                    <label class="mb-1" for="password">Year and Section <b>(BSIT)</b></label>
                    <select id="yearandsection" name="yearandsection" class="form-control" required>
                      @for($i=1; $i <= 4; $i++)
                      <optgroup label="{{$i}}">
                        <option value="BSIT{{$i}}-A"><b>BSIT</b> {{$i}} - A</option>
                        <option value="BSIT{{$i}}-B"><b>BSIT</b> {{$i}} - B</option>
                        <option value="BSIT{{$i}}-C"><b>BSIT</b> {{$i}} - C</option>
                        <option value="BSIT{{$i}}-D"><b>BSIT</b> {{$i}} - D</option>
                        <option value="BSIT{{$i}}-E"><b>BSIT</b> {{$i}} - E</option>
                        <option value="BSIT{{$i}}-F"><b>BSIT</b> {{$i}} - F</option>
                      </optgroup>
                      @endfor
                    </select>
                    {{-- <input type="yearandsection" name="yearandsection" id="yearandsection" placeholder="" class="form-control"> --}}
                </div>

                  <div class="col-sm-12 mb-1">
                      <label class="mb-1" for="email">Student ID</label>
                      <br>
                      <input type="stud_id" name="stud_id" id="stud_id" placeholder=""  required
                      class="form-control">
                  </div>

                  <div class="col-sm-12 mb-1">
                      <label class="mb-1" for="password">Email</label>
                      <input type="email" name="email" id="email" placeholder=""  required
                      class="form-control">
                  </div>

                 <div class="col-sm-12 mb-1">
                    <label class="mb-1" for="password">Contact No.</label>
                    <input type="contact_no" name="contact_no" id="contact_no" placeholder=""  required
                    class="form-control">
                 </div>

                  <div class="col-sm-12 mb-1 mt-2">
                      <button type="submit" class="btn btn-primary">Add student</button>
                  </div>
            </div>
          </div>
      </div>
  </div>
</form>
@endsection
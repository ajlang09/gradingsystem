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
                    <select id="class_name" name="class_name" class="form-control" required>
                      @for($i=1; $i <= 4; $i++)
                      <optgroup label="{{$i}}">
                        <option value="BSIT{{$i}}-A 1ST HALF"><b>BSIT</b> {{$i}} - A 1ST HALF</option>
                        <option value="BSIT{{$i}}-A 2ND HALF"><b>BSIT</b> {{$i}} - A 2ND HALF</option>
                        <option value="BSIT{{$i}}-B 1ST HALF"><b>BSIT</b> {{$i}} - B 1ST HALF</option>
                        <option value="BSIT{{$i}}-B 2ND HALF"><b>BSIT</b> {{$i}} - B 2ND HALF</option>
                        <option value="BSIT{{$i}}-C 1ST HALF"><b>BSIT</b> {{$i}} - C 1ST HALF</option>
                        <option value="BSIT{{$i}}-C 2ND HALF"><b>BSIT</b> {{$i}} - C 2ND HALF</option>
                        <option value="BSIT{{$i}}-D 1ST HALF"><b>BSIT</b> {{$i}} - D 1ST HALF</option>
                        <option value="BSIT{{$i}}-D 2ND HALF"><b>BSIT</b> {{$i}} - D 2ND HALF</option>
                        <option value="BSIT{{$i}}-E 1ST HALF"><b>BSIT</b> {{$i}} - E 1ST HALF</option>
                        <option value="BSIT{{$i}}-E 2ND HALF"><b>BSIT</b> {{$i}} - E 2ND HALF</option>
                        <option value="BSIT{{$i}}-F 1ST HALF"><b>BSIT</b> {{$i}} - F 1ST HALF</option>
                        <option value="BSIT{{$i}}-F 2ND HALF"><b>BSIT</b> {{$i}} - F 2ND HALF</option>
                      </optgroup>
                      @endfor
                    </select>
                    {{-- <input type="class_name" name="class_name" id="class_name" placeholder="" class="form-control"> --}}
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

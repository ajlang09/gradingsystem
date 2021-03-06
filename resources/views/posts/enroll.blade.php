@extends('layouts.app')

@section('content')
<div class="components">
    {{-- <test-component/> --}}
    <form action="{{ route('classes.update') }}" method="post">
        @csrf
        <div class="row">
            <div class="offset-sm-3 col-sm-6 col-12">
                <div class="card mt-5">
                    <div class="card-body">
                        <h5 class="card-title">CLASS EDIT FORM</h5>
                        <hr>
                        <div class="row">
                            <input type="hidden" name="class_id" value="{{$data->class_id}}" id="class_id">
                            <div class="col-sm-12 mb-1">
                                <label class="mb-1" for="class_name">Class Name</label>
                                <br>
                                <input type="text" name="class_name" id="class_name" value="{{$data->class_name}}" class="form-control">
                            </div>
                            <div class="col-sm-12 mb-1">
                                <label class="mb-1" for="year">Year</label>
                                <br>
                                <input type="text" name="year" id="year" value="{{$data->year}}" class="form-control">
                            </div>
                            <div class="col-sm-12 mb-1">
                                <label class="mb-1" for="semester">Semester</label>
                                <br>
                                <select class="form-control" name="semester" id="semester" required>
                                  <option value=""></option>
                                  <option value="first-semester" {{'first-semester' == $data->semester ? 'selected' : ''}} >1st semester</option>
                                  <option value="second-semester" {{'second-semester' == $data->semester ? 'selected' : '' }}>2nd semester</option>
                                </select>
                            </div>
                            <div class="col-sm-12 mb-1 mt-2">
                                <button type="submit" class="btn btn-primary" name="action" value="update-class">UPDATE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-sm-6 col-12">
                <student-list />
            </div>
            <div class="col-sm-6 col-12">
                <subject-list />
            </div> --}}
        </div>

    </form>
</div>
@endsection

@section('script')
<script src="{{ asset(mix('/js/components.js')) }}"></script>
@endsection

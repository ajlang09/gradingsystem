@extends('layouts.app')

@section('content')
<div class="components">
    <div class="row mt-3">
        <div class="col-12">
            <h5>ENROLL FORM</h5>
            <input type="hidden" name="class_id" value="{{$data->class_id}}" id="class_id">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-12">
            <student-list />
        </div>
        <div class="col-sm-6 col-12">
            <subject-list />
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset(mix('/js/components.js')) }}"></script>
@endsection
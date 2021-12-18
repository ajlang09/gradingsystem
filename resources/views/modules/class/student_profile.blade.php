@extends('layouts.app')

@section('content')
<div class="student-profile components">
    <div class="row mt-4">
        <div class="col-12">
            <h3 class="float-left">Student Class Profile</h3>
            <h3 class="float-right">{{$class->class_name}}</h3>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <label>Name:</label>
            <span><b>{{$student->name}}</b></span>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <label>Email:</label>
            <span><b>{{$student->email}}</b></span>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <label>Contact No.:</label>
            <span><b>{{$student->contact_no}}</b></span>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <student-grade :subjects="{{json_encode($subjects)}}"/>
        </div>
    </div>
    <div class="row">
        <div class="col-12" align="right">
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset(mix('/js/components.js')) }}"></script>
@endsection
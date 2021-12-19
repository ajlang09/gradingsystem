@extends('layouts.app')

@section('content')
<div class="subject">
    <div class="row mt-4">
        <div class="col-6">
            <h4>{{$classRecord->name}}</h4>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover mt-2" id="subject-table">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>Student</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{$student->name}}</td>
                                <td>
                                    <a href="{{route('students.subject',[$student->id, $classRecord->class_id])}}" class="btn btn-warning">Grade</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready( function () {
    $('#subject-table').DataTable({
         "aaSorting": [],
    })
});
</script>
@endsection
@extends('layouts.app')

@section('content')
<div class="row mt-4 mb-4">
    <div class="col-12">
        <h1>{{$class->class_name}}</h1>        
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-6 pl-2 pr-2">
        <div class="row mt-3">
            <div class="col-sm-12">
                <h3 class="float-start">Students</h3>
                {{-- <a class="float-end btn btn-primary "href="classes.add">Add Student</a> --}}
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-12">
                <table class="table table-striped table-hover" id="classes_records_table">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>
                                Student Name
                            </th>
                            <th>
                                Student ID
                            </th>
                            <th>
                                ACTION
                            </th>
                            
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>
                                {{$student->name}}
                            </td>
                            
                            <td>
                                {{$student->stud_id}}
                            </td>
                            <td>
                                <a class="btn btn-warning" href="{{route('classes.edit',$class->class_id)}}">Edit Grade</a>
                                <form method="post" action="{{route('remove.student')}}">
                                    @csrf
                                    <input type="hidden" name="class_id" value="{{$class->class_id}}">
                                    <input type="hidden" name="student_id" value="{{$student->id}}">
                                    <button type="submit" class="btn btn-danger">UNENROLL</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6">
        <div class="row mt-3">
            <div class="col-sm-12">
                <h3 class="float-start">Subjects</h3>
                {{-- <a class="float-end btn btn-primary "href="classes.add">Add Student</a> --}}
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-12">
                <table class="table table-striped table-hover" id="classes_subject">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>
                                Name
                            </th>
                            <th>
                                ACTION
                            </th>
                            
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach($subjects as $subject)
                        <tr>
                            <td>
                                {{$subject->name}}
                            </td>
                            
                            <td>
                                <form method="post" action="{{route('remove.subject')}}">
                                    @csrf
                                    <input type="hidden" name="class_id" value="{{$class->class_id}}">
                                    <input type="hidden" name="subject_id" value="{{$subject->id}}">
                                    <button type="submit" class="btn btn-danger">Remove subject</button>
                                </form>
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
    $('#classes_records_table').DataTable();
    $('#classes_subject').DataTable();
} );
</script>
@endsection
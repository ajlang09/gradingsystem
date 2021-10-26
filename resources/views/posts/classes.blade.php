@extends('layouts.app')

@section('content')
<div class="row mt-3">
    <div class="col-sm-12">
        <h1 class="float-start">STUDENT RECORD</h1>
        <a class="float-end btn btn-primary "href="{{route('student.add')}}">ADD STUDENT RECORD</a>
    </div>
</div>

    <div class="row mt-2">
        <div class="col-sm-12">
        <table class="table table-striped table-hover" id="student_record_table">
            <thead class="bg-secondary text-white">
                <tr>
                    <th>
                        Student
                    </th>
                    <th>
                        Section 
                    </th>
                    <th>
                        Contact No
                    </th>
                    <th>
                        Email
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
                @foreach($studentRecords as $studentRecord)
                  
                     <tr>
                    <td>
                        {{$studentRecord->name}}
                    </td>
                    
                    <td>
                        {{$studentRecord->yearandsection}}
                    </td>
                    
                    <td>
                        {{$studentRecord->contact_no}}
                    </td>

                    <td>
                        {{$studentRecord->email}}
                    </td>
                    <td>
                        {{$studentRecord->stud_id}}
                    </td>
                    <td>
                        <a class="btn btn-warning" href="{{route('student.edit',$studentRecord->id)}}">Edit</a>
                        <form method="post" action="{{route('student.delete')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$studentRecord->id}}">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>    
                @endforeach
                           
            </tbody>
            
        </table>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready( function () {
    $('#student_record_table').DataTable();
} );
</script>
@endsection
@extends('layouts.app')

@section('content')
<div class="row mt-3">
    <div class="col-sm-12">
     
        <h1 class="float-start">GRADES RECORDS FOR (THE SUBJECT)</h1>
       
        <a class="float-end btn btn-primary "href="classes.add">Add Student</a>
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
                      Year and Section
                    </th> 
                    <th>
                        Student ID
                    </th>
                    <th>
                        Raw Grade
                    </th>
                    <th>
                        Transmuted Grade
                    </th>
                    <th>
                        ACTION
                    </th>
                
                </tr>
            </thead>
            
            <tbody>
                @foreach($classesRecord as $ClassesRecords)
                
                     <tr>

                    <td>
                        {{$ClassesRecords->students}}Allan Joseph Lorenzo
                    </td>
                    
                    <td>
                        {{$ClassesRecords->students}}BSIT4B
                    </td>
                    <td>
                        {{$ClassesRecords->students}}2018001203
                    </td>

                    <td>
                        {{$ClassesRecords->students}}98.5
                    </td>
                    
                    <td>
                        {{$ClassesRecords->students}}1.25
                    </td>

                    <td>
                        <a class="btn btn-warning" href="{{route('classes.edit',$ClassesRecords->class_id)}}">Edit Grade</a>
                        <form method="post" action="{{route('classes.delete')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$ClassesRecords->class_id}}">
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
    $('#classes_records_table').DataTable();
} );
</script>
@endsection
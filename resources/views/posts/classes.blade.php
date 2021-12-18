@extends('layouts.app')

@section('content')
<div class="row mt-3">
    <div class="col-sm-12">
        <h1 class="float-start">CLASSES RECORD</h1>
        <a class="float-end btn btn-primary "href="{{route('classes.add')}}">ADD CLASS</a>
    </div>
</div>

    <div class="row mt-2">
        <div class="col-sm-12">
        <table class="table table-striped table-hover" id="classes_records_table">
            <thead class="bg-secondary text-white">
                <tr>
                    <th>
                        Class ID
                    </th>
                    <th>
                      Class Name
                    </th> 
                    <th>
                        Students
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
                        
                        {{$ClassesRecords->class_id}}
                    </td>
                    
                    <td>
                       {{$ClassesRecords->class_name}}</a>
                    </td>
                    
                    <td>
                        {{$ClassesRecords->students()->count()}}
                    </td>

                    <td>
                        <a class="btn btn-warning" href="{{route('classes.edit',$ClassesRecords->class_id)}}">Edit/Enroll</a>
                        <a class="btn btn-primary" href="{{route('classes.classview',$ClassesRecords->class_id)}}">See Details</a>

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
@extends('layouts.app')

@section('content')
<div class="class">
    <div class="row mt-4">
        <div class="col-6">
            <h4>Classes</h4>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover mt-2" id="class-table">
                	<thead>
                		<tr>
                			<th>Class Name</th>
                			<th>Semester</th>
                			<th>Year</th>
                			<th>Action</th>
                		</tr>
                	</thead>
                	<tbody>
                		@foreach($classes as $class)
                		<tr>
	                		<td>{{ $class->class_name }}</td>
	                		<td>{{ ucfirst(str_replace('-', ' ', $class->semester)) }}</td>
	                		<td>{{ $class->year }}</td>
	                		<td><a href="{{route('student.auth.grades', $class->class_id)}}" class="btn btn-primary">View Grade</a></td>
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
    $('#class-table').DataTable()
});
</script>
@endsection
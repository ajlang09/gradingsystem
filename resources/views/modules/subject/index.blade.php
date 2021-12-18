@extends('layouts.app')

@section('content')
<div class="subject">
    <div class="row mt-4">
        <div class="col-6">
            <h4>Subject</h4>
        </div>
        <div class="col-6">
            <a href="{{route('subject.create')}}" class="btn btn-primary float-right">Add subject</a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover mt-2" id="subject-table">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>Subject</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subjects as $subject)
                        <tr>
                            <td>{{$subject->name}}</td>
                            <td>
                                <a href="{{route('subject.edit',$subject->id)}}" class="btn btn-warning">Edit</a>
                                <form action="{{route('subject.destroy',$subject->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
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
    $('#subject-table').DataTable()
});
</script>
@endsection
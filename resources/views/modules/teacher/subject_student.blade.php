@extends('layouts.app')

@section('content')
<a href="javascript:void(0)" onclick="screenCap()" class="btn btn-primary float-right">Capture</a>
<div class="subject" id="subject-list">

    <div class="row mt-4">
        <div class="col-6">
            <h4>{{$subject->name}}</h4>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover mt-2" id="subject-table">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>Student</th>
                            <th>Class</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            @foreach($student['students'] as $rawStudent)
                                <tr>
                                    <td>{{$rawStudent->name}}</td>
                                    <td>{{ $student['class']->class_name }} {{ $student['class']->year ?'- '.$student['class']->year:'' }}</td>
                                    <td>
                                        <a href="{{route('students.subject',[$rawStudent->id, $student['class']->class_id])}}" class="btn btn-warning">Grade</a>
                                    </td>
                                </tr>
                            @endforeach
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

function screenCap() {
    // const screenshotTarget = document.body;
    const screenshotTarget = document.getElementById('subject-list');


    html2canvas(screenshotTarget).then((canvas) => {
        const base64image = canvas.toDataURL("image/png");
         var a = document.createElement("a"); //Create <a>
        a.href = base64image; //Image Base64 Goes here
        a.download = "Image.png"; //File name Here
        a.click(); //Downloaded file
        // document.getElementById('screen-cap').src = base64image
    });
}
</script>
@endsection

@extends('layouts.app')

@section('content')
<a href="javascript:void(0)" onclick="screenCap()" class="btn btn-primary float-right">Capture</a>
<div class="subject">
<div id="student-list">
    <div class="row mt-4">
        <div class="col-6">
            <h4>{{$classRecord->class_name}}</h4>

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
    const screenshotTarget = document.getElementById('student-list');


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

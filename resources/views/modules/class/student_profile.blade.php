@extends('layouts.app')

@section('content')
<div class="student-profile components">
    <div class="row mt-4">
        <div class="col-12">
            <a href="{{route('classes.classview',$class->class_id)}}" class="btn btn-danger">Back</a>
            <a href="javascript:void(0)" onclick="screenCap()" class="btn btn-primary float-right">Capture</a>
        </div>
    </div>
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
    {{-- <form action="{{route('student.grade')}}" method="post"> --}}
        @csrf
        <input type="hidden" name="class_id" value="{{$class->class_id}}">
        <input type="hidden" name="student_id" value="{{$student->id}}">
        <div class="row">
            <div class="col-12">
                <student-grade studentid="{{$student->id}}" classid="{{$class->class_id}}" :subjects="{{json_encode($subjects)}}" :mappedgrades="{{json_encode($grades)}}" />
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-12" align="right">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </div> --}}
    {{-- </form> --}}
</div>
@endsection
@section('script')
<script src="{{ asset(mix('/js/components.js')) }}"></script>
<script type="text/javascript">


function screenCap() {
    const screenshotTarget = document.body;

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
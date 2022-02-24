@extends('layouts.app')

@section('content')
<a href="javascript:void(0)" onclick="screenCap()" class="btn btn-primary float-right">Capture</a>
<div class="components">
    <div id="class-list">
        <teacher-class-list />
    </div>
</div>
@endsection

@section('script')
<script>
    function screenCap() {
    // const screenshotTarget = document.body;
    const screenshotTarget = document.getElementById('class-list');


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
<script src="{{ asset(mix('/js/components.js')) }}"></script>

@endsection

@extends('layouts.app')

@section('content')
<a href="javascript:void(0)" onclick="screenCap()" class="btn btn-primary float-right">Capture</a>
<div id="ranking-tables">
    <div class="components">
        <ranking-table :classes="{{json_encode($classes)}}" :subjects="{{json_encode($subjects)}}"/>
    </div>
</div>
@endsection

@section('script')
<script>
    function screenCap() {
    // const screenshotTarget = document.body;
    const screenshotTarget = document.getElementById('ranking-tables');


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

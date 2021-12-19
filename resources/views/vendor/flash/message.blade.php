<script>
@foreach (session('flash_notification', collect())->toArray() as $message)
    setTimeout(function(){
        @if($message['level'] == 'error')
            alertify.error("{{$message['message']}}")
        @elseif($message['level'] == 'danger')
            alertify.error("{{$message['message']}}")
        @else
            alertify.success("{{$message['message']}}")
        @endif
    },300)
@endforeach
</script>

{!! session()->forget('flash_notification') !!}

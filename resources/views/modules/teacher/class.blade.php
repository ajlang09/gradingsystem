@extends('layouts.app')

@section('content')
<div class="components">
    <teacher-class-list />
</div>
@endsection

@section('script')
<script src="{{ asset(mix('/js/components.js')) }}"></script>
@endsection

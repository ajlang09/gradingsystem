@extends('layouts.app')

@section('content')
<div class="components">
    <ranking-table :classes="{{json_encode($classes)}}" :subjects="{{json_encode($subjects)}}"/>
</div>
@endsection

@section('script')
<script src="{{ asset(mix('/js/components.js')) }}"></script>
@endsection

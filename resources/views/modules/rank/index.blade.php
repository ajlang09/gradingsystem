@extends('layouts.app')

@section('content')
<div class="components">
    <ranking-table />
</div>
@endsection

@section('script')
<script src="{{ asset(mix('/js/components.js')) }}"></script>
@endsection

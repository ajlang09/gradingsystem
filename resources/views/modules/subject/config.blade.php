@extends('layouts.app')

@section('content')
<div class="subject">
    <form action="{{route('subjects.save.config')}}" method="post">
        @csrf
        <input type="hidden" name="subject_id" value="{{$subjectId}}">
        <div class="card mt-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <b>Config</b>
                    </div>
                    <div class="col-6">
                        <b>Percentage</b>
                    </div>
                </div>
                @foreach($configs as $config)
                <div class="row mt-3">
                    <div class="col-6">
                        <input type="text" class="form-control" name="name[]" value="{{$config['label']}}">
                    </div>
                    <div class="col-5">
                        <input type="text" class="form-control" name="percentage[]" value="{{100 * $config['percentage']}}">
                    </div>
                    <div class="col-1" align="center">
                        <button type="submit" class="btn btn-danger" name="action" value="{{$config['label']}}">x</button>
                    </div>
                </div>
                @endforeach
                <div class="row mt-3">
                    <div class="col-6">
                        <input type="text" class="form-control" name="name[]">
                    </div>
                    <div class="col-5">
                        <input type="text" class="form-control" name="percentage[]">
                    </div>
                    <div class="col-1" align="center">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <button type="submit" name="action" class="btn btn-primary" value="save">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
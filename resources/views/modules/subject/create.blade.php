@extends('layouts.app')

@section('content')
<div class="subject">
    <div class="row">
        <div class="col-12 offset-3 col-sm-6">
            <div class="card mt-5">
                <div class="card-body">
                    <h5 class="card-title">SUBJECT</h5>
                    <hr>
                    <form action="{{route('subject.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control mt-2" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection

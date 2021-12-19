@extends('layouts.app')

@section('content')
<div class="subject">
    <div class="row mt-3">
        <div class="col-12">
            <div class="card mt-5">
                <form method="post" action="{{route('users.update', $user->id)}}">
                    @csrf
                    @method('patch')
                    <div class="card-body">
                        <h5 class="card-title">USER</h5>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 mb-1">
                                <label class="mb-1" for="name">Name</label>
                                <br>
                                <input required type="text" name="name" id="name" value="{{$user->name}}" placeholder=""
                                class="form-control">
                            </div>
                            <div class="col-sm-12 mb-1">
                                <label class="mb-1" for="email">Email</label>
                                <br>
                                <input required type="email" name="email" id="email" value="{{$user->email}}" placeholder=""
                                class="form-control">
                            </div>
                            <div class="col-sm-12 mb-1">
                                <label class="mb-1" for="username">Username</label>
                                <br>
                                <input required type="text" name="username" id="username" value="{{$user->username}}" placeholder=""
                                class="form-control">
                            </div>
                            <div class="col-sm-12 mb-1">
                                <label class="mb-1" for="password">Password</label>
                                <br>
                                <input  type="password" name="password" id="password" placeholder=""
                                class="form-control">
                            </div>
                            <div class="col-sm-12 mb-1">
                                <label class="mb-1" for="password">Role</label>
                                <br>
                                <select class="form-control" name="role_id">
                                    @foreach($roles as $role)
                                    <option value="{{$role->id}}" {{$role->id == $user->roles()->first()->id ? 'selected' : ''}}>{{ucfirst($role->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 mb-1 mt-2">
                                <a href="{{route('users.index')}}" class="btn btn-danger">Back</a>
                                <button type="submit" class="btn btn-primary float-right">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
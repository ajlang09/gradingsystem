@extends('layouts.app')

@section('content')
<div class="subject">
    <div class="row mt-4">
        <div class="col-6">
            <h4>Users</h4>
        </div>
        <div class="col-6">
            <a href="{{route('users.create')}}" class="btn btn-primary float-right">Add User</a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover mt-2" id="user-table">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->roles()->first()->name}}</td>
                            <td>
                                <a href="{{route('users.edit',$user->id)}}" class="btn btn-warning">Edit</a>
                                @if(auth()->id() != $user->id)
                                <form action="{{route('users.destroy',$user->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready( function () {
    $('#user-table').DataTable()
});
</script>
@endsection
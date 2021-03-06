@extends('layouts.app')

@section('content')
<form action="{{ route('register') }}" method="post">
@csrf
<div class="row">
    <div class="col-md-6 offset-md-3 col-sm-12">
      <div class="card mt-5">
          <div class="card-body">
            <h5 class="card-title">Register</h5>
            <hr>
            <div class="row">
                <div class="col-sm-12 mb-1">
                    <label class="mb-1" for="email">Name</label>
                    <br>
                    <input type="text" name="name" id="name" placeholder="" 
                    class="form-control @error('email') border-red-500 @enderror" value="{{old('name')}}">
                </div>

                <div class="col-sm-12 mb-1">
                    <label class="mb-1" for="password">Username</label>
                    <input type="username" name="username" id="username" placeholder="" 
                    class="form-control @error('password') border-red-500 @enderror" value="">
                </div>

                  <div class="col-sm-12 mb-1">
                      <label class="mb-1" for="email">Email</label>
                      <br>
                      <input type="text" name="email" id="email" placeholder="" 
                      class="form-control @error('email') border-red-500 @enderror" value="{{old('email')}}">
                  </div>

                  <div class="col-sm-12 mb-1">
                      <label class="mb-1" for="password">Password</label>
                      <input type="password" name="password" id="password" placeholder="" 
                      class="form-control @error('password') border-red-500 @enderror" value="">
                  </div>

                 <div class="col-sm-12 mb-1">
                    <label class="mb-1" for="password">Retype password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="" 
                    class="form-control @error('password') border-red-500 @enderror" value="">
                 </div>

                  <div class="col-sm-12 mb-1 mt-2">
                      <button type="submit" class="btn btn-primary">Register</button>
                  </div>
            </div>
          </div>
      </div>
  </div>
</form>
@endsection
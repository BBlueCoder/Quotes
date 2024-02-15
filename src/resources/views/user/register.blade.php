@extends('welcome')

@section('content')
    
    <div class="row d-flex justify-content-center">
        <div class="col-4 bg-dark-subtle mt-4 p-3 rounded">
            <h2 class="text-body-secondary">Register</h2>
            <form action="/user/create" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>  
                    <input type="text" class="form-control" name="username" value="{{old('username')}}">

                    @error('username')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" value="{{old('email')}}">

                    @error('email')
                        <p class="text-danger">{{$message}}</p>
                    @enderror                    
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" value="{{old('password')}}">

                    @error('password')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                    
                
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}">

                    @error('password_confirmation')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="profile-pic" class="form-label">Upload a profile picture</label>
                    <input class="form-control" type="file" name="profile-pic">
                  </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection
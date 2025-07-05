@extends('tools.unauth_head')
@section('title')
    | Register
@endsection

@section('content')
    <div class="container mt-5 col-md-4">
        <h2>Register</h2>
        <form action="/register/user" method="POST">
            @csrf
            <div class="mb-3">
                <label>Username</label>
                <input type="text" class="form-control" required name="username" value="{{ old('username') }}">
                @error('username')
                    <p class="text-danger">{{ $message}} only lowercases, letters and numbers, no spaces</p>
                @enderror
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" class="form-control" required name="email" value="{{ old('email') }}">
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" class="form-control" required name="password" value="{{ old('password') }}">
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                    required>
                @error('password_confirmation')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
@endsection
    @section('footer')
    @include('tools.footer')
    @endsection

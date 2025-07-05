@extends('tools.unauth_head')

@section('title')
    | Login
@endsection

@section('content')
    <div class="container mt-5 col-md-4">
        <h2>Login</h2>
        <form method="post" action="/login/user">
            @csrf
            <div class="mb-3">
                <label>Email address</label>
                <input type="email" class="form-control" required name="email">
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" class="form-control" required name="password">
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Login</button>

            @if (session('error'))
                <div class="alert alert-danger mt-2">{{ session('error') }}</div>
            @endif
        </form>
    </div>
@endsection

    @section('footer')
    @include('tools.footer')
    @endsection

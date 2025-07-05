@extends('tools.unauth_head')

@section('content')
    @if (session()->has('message'))
        <div class="alert alert-secondary alert-dismissible fade show container" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close btn-danger" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container text-center mt-5">
        <h1>Welcome to Confess Me</h1>
        <p>Send anonymous messages without revealing your identity.</p>
        <a href="/register" class="btn btn-primary btn-lg mt-3">Get Started</a>
    </div><br><hr class="m-2">
    <div class="container text-center">
        <form action="/search" method="GET" class="d-flex mb-4 nav-item" role="search">
            <input type="text" name="query" class="form-control me-2" placeholder="Search by username" required>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
    @section('footer')
    @include('tools.footer')
    @endsection
@endsection

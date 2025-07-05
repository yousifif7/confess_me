@extends('tools.auth_head')
@section('content')
    <?php
    // $messages = App\Models\Requests::all();
    ?>

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show container" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close btn-danger" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container mt-5">
        <h2>Welcome Back! <b>{{ Auth::user()->username }}</b></h2>
        <p>Check your messages or update your profile.</p>
    </div>
    <hr class="m-2">
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

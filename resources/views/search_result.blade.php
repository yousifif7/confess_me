@auth
    @include('tools.auth_head')
@endauth
@guest
    @include('tools.unauth_head')
@endguest


<div class="container">
    <div class="container text-center mt-4">
        <form action="/search" method="GET" class="d-flex mb-4 nav-item" role="search">
            <input type="text" name="query" class="form-control me-2" placeholder="Search by username" required>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
    <hr class="m-2">
    <h4>Search Results for "{{ $query }}", Found {{count($users)}} results</h4>

    @if ($users->count() > 0)
        <div class="list-group mt-3">
            @foreach ($users as $user)
                <a href="/profile/{{ $user->id }}" class="list-group-item list-group-item-action">
                    {{ $user->username }}
                </a>
            @endforeach
        </div>
    @else
        <p class="text-muted mt-3">No users found.</p>
    @endif

    
</div>
    @include('tools.footer')

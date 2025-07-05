@auth
    @include('tools.auth_head')
@endauth

@guest
    @include('tools.unauth_head')
@endguest

@if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show container" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close btn-danger" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="container mt-5 col-md-10">
    <h3 class="card-title text-center">This is profile of, <b class="text-danger">{{ $user->username }}</b></h3><br>
    <div class="card mb-4">
        <div class="row g-0">
            <div class="col-md-4 text-center p-4">
                <div>
                    <img src="{{ $user->picture ? asset('storage/' . $user->picture) : asset('/profilePic.png') }}"
                        class="img-fluid rounded" alt="Profile Picture"
                        style="width:300px; height:300px; object-fit:cover;">
                </div>
                <br>
                @auth
                    <div>
                        <!-- Button to Trigger Modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#editProfileModal">
                            Confess him
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="/message/store" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editProfileModalLabel">Confess,
                                                {{ $user->username }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <input hidden name="sender_id" value="{{ Auth::id() }}">
                                        <input hidden name="receiver_id" value="{{ $user->id }}">
                                        <div class="mb-3">
                                            <label for="body" class="form-label">Message content</label>
                                            <textarea name="body" id="body" rows="3" class="form-control"
                                                placeholder="Send {{ $user->username }} a secret message"></textarea>
                                            @error('body')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <p class="card-text"><strong>Bio:</strong> {{ $user->bio }}</p>
                    <p class="card-text"><strong>Gender:</strong> {{ $user->gender }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

    @include('tools.footer')


@extends('tools.auth_head')

@section('title')
    | MY profile
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show container" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close btn-danger" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container mt-5 col-md-10">
        <h3 class="card-title text-center">This is your profile, <b class="text-danger">{{ $user->username }}</b></h3><br>
        <div class="card mb-4">
            <div class="row g-0">
                <div class="col-md-4 text-center p-4">
                    <div>

                        <img src="{{ $user->picture ? asset('storage/' . $user->picture) : asset('/profilePic.png') }}"
                            class="img-fluid rounded" alt="Profile Picture"
                            style="width:300px; height:300px; object-fit:cover;">
                    </div>
                    <br>
                    <div>
                        <!-- Button to Trigger Modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#editProfileModal">
                            Edit Profile
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="/update/{{ Auth::id() }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT') {{-- Or PUT if updating --}}
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <!-- Profile Picture -->
                                            <div class="mb-3">
                                                <label for="profile_photo" class="form-label">Profile Picture</label>
                                                <input type="file" class="form-control" name="picture"
                                                    id="profile_photo">
                                                @error('picture')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Bio -->
                                            <div class="mb-3">
                                                <label for="bio" class="form-label">Bio</label>
                                                <textarea name="bio" id="bio" rows="3" class="form-control"
                                                    placeholder="Tell us something about yourself">{{ old('bio', $user->bio ?? '') }}</textarea>
                                            </div>

                                            <!-- Gender -->
                                            <div class="mb-3">
                                                <label for="gender" class="form-label">Gender</label>
                                                <select name="gender" id="gender" class="form-select">
                                                    <option value="" disabled
                                                        {{ empty($user->gender) ? 'selected' : '' }}>Select Gender</option>
                                                    <option value="male"
                                                        {{ ($user->gender ?? '') === 'male' ? 'selected' : '' }}>Male
                                                    </option>
                                                    <option value="female"
                                                        {{ ($user->gender ?? '') === 'female' ? 'selected' : '' }}>Female
                                                    </option>
                                                    <option value="other"
                                                        {{ ($user->gender ?? '') === 'other' ? 'selected' : '' }}>Other
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($user->picture)
                        <div class="mb-3">
                            {{-- <img src="{{ asset('storage/' . $user->picture) }}" alt="Profile Picture" class="rounded-circle"
                                style="width:150px; height:150px; object-fit:cover;"> --}}
                            <form action="/delete/picture" method="POST" class="mt-2" id="delete_picture">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete
                                    Picture</button>
                            </form>
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                        <p class="card-text"><strong>Bio:</strong> {{ $user->bio }}</p>
                        <p class="card-text"><strong>Gender:</strong> {{ $user->gender }}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('delete_picture');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const confirmDelete = confirm('Are you sure you want to delete your profile picture?');
                    if (!confirmDelete) {
                        e.preventDefault(); // 🚫 stop form from submitting
                    }
                });
            }
        });
    </script>
@endsection

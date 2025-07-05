<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UsersController extends Controller
{
    //Showing regitser form
    public function register()
    {

        return view('auth.register');
    }


    public function login()
    {

        return view('auth.login');
    }

    public function loginUser(Request $request)
    {
        $formFields = $request->only('email', 'password');

        if (Auth::attempt($formFields)) {
            return redirect('/main')->with('message', 'You are logged in succesfully!');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('message', 'You are logged out succesfully!');
    }

    public function store(Request $request, User $user)
    {
        $formFields = $request->validate([
            'username' => ['required', 'min:3', Rule::unique("users", "username"), 'string', 'regex:/^[a-z0-9]+$/', 'max:20'],
            'email' => ['required', Rule::unique("users", "email")],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);
        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);
        Auth::login($user);


        return redirect('/main');
    }

    //Showing profiles.
    public function profile($id)
    {
        $user = User::findOrFail($id);

        // Check who is the user to show his own profile or others profile
        if (Auth::id() == $user->id) {

            return view('profile.user', ['user' => $user]);
        } else {
            return view('profile.other', ['user' => $user]);
        }
    }

    // Updating profile
    public function update(Request $request, User $user)
    {
        $formFields = $request->validate([
            'gender' => '',
            'bio' => '',
            'picture' => 'mimes:png,jpg,jpeg|max:3000',
        ]);
        $user->gender = $formFields['gender'] ?? $user->gender;
        $user->bio = $formFields['bio'] ?? $user->bio;
        $user->save();

        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('profile_pictures', 'public');
            $user->picture = $path;
        }

        $user->save($formFields);
        return back()->with('message', 'Profile updated succesfully!');
    }

    public function deletePicture(Request $request)
    {
        $user = Auth::user();

        if ($user->picture && Storage::disk('public')->exists($user->picture)) {
            Storage::disk('public')->delete($user->picture);
        }

        $user->picture = null;
        $user->save();

        return back()->with('message', 'Profile picture deleted successfully.');
    }

    public function search(Request $request)
{
    $query = $request->input('query');

    $users = User::where('username', 'like', '%' . $query . '%')->get();

    return view('search_result', compact('users', 'query'));
}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class userController extends Controller
{
    public function showAdminHome()
    {
        return view('admin.home');
    }
    public function index()
    {
        $users = User::paginate(5);
        return view('admin.profile.index',compact('users'));
    }
    public function showAddadminForm()
    {
        return view('admin.profile.add-admin');
    }
    public function showLoginForm()
    {
        return view('admin.login');
    }
    public function showChangepasswordForm(User $user)
    {
        return view('admin.profile.change-password', compact('user'));

    }

    public function addAdmin(Request $request)
    {
        // Validate user input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed|alpha_dash|unique:users',


        ]);
        $validator->after(function ($validator) use ($request) {
            $request->merge([
                'name' => strip_tags($request->name),
                'email' => strip_tags($request->email),
                'password' => strip_tags($request->password),
            ]);
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();


        return redirect()->back()->with('success', 'admin added successfully.');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            return redirect()->route('admin.home');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }


    public function show(User $user)
{
    // Retrieve the user
    $user = User::find($user->id);

    // Check if the user exists
    if (!$user) {
        return redirect()->back()->with('error', 'User not found.');
    }

    return view('admin.profile.show', compact('user'));
}

    public function edit(User $user)
    {
        return view('admin.profile.edit', compact('user'));

    }

    public function update(Request $request, User $user)
    {
        $validator= Validator::make($request->all() ,[
            'name' => 'required|string|max:255|alpha_dash',
            'email' => 'required|string|email|max:255|exists:users',
        ]);
        $validator->after(function ($validator) use ($request) {
            $request->merge([
                'name' => strip_tags($request->name),
                'email' => strip_tags($request->email),
                'password' => strip_tags($request->password),
            ]);
        });
        $user->update($request->all());
        $user->save();
        return redirect()->back()->with('success', 'Profile updated successfully.');

    }


    public function changePassword(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('password.change.form',$user->id)
                ->withErrors($validator)
                ->withInput();
        }


        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('password.change',$user->id)
                ->withErrors(['current_password' => 'Current password is incorrect'])
                ->withInput();
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('password.change.form',$user->id)->with('success', 'Password changed successfully');
    }

    public function destroy(User $user){
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }

}

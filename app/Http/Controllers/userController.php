<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ForgetPasswordEmail;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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

    public function showUserLoginForm()
    {
        return view('login');
    }

    public function showRegisterForm()
    {
        return view('register');
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
        $user->is_admin = true;
        $user->save();


        return redirect()->back()->with('success', 'admin added successfully.');
    }

    public function register(Request $request)
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
        $user->is_admin = false;
        $user->save();


        return redirect()->route('login')->with('success', 'user registered successfully, sign in to your account');
    }



    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            // Check if the authenticated user is an admin
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.home');
            } else {
                // If the user is not an admin, log them out and deny access
                Auth::logout();
                return redirect()->route('admin.login')
                    ->withErrors(['email' => 'You do not have access to the admin panel.']);
            }
        }

        // If authentication fails, redirect back with errors
        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => 'These credentials do not match our records.',
            ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            // Check if the authenticated user is an admin
            if (Auth::user()->is_admin) {
                // If the user is an admin, redirect them to the admin home
                return redirect()->route('admin.home');
            } else {
                // If the user is not an admin, redirect them to the home route
                return redirect()->route('home');
            }
        }

        // If authentication fails, redirect back with errors
        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
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
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                ->withErrors(['current_password' => 'Current password is incorrect'])
                ->withInput();
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully');
    }

    public function showProfile(){
        $user = User::find(Auth::user()->id);
        return view('profile', compact('user'));
    }
    public function destroy(User $user){
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }


    public function showResetForm(Request $request, $token = null)
    {
        return view('password-reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        // Reset the password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // Redirect with status message
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function showForgotPasswordForm()
    {
        return view('forget-password');
    }
    /**
     * Send a password reset link to the given user.
     */
    public function sendForgetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Send the password reset link
        $status = Password::sendResetLink(
            $request->only('email'),
            function ($user, $token) {
                // Generate the password reset URL
                $url = url(route('password.reset', [
                    'token' => $token,
                    'email' => $user->email,
                ], false));

                // Send the custom email
                Mail::to($user->email)->send(new ForgetPasswordEmail($url));
            }
        );

        // Redirect with status message
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

}

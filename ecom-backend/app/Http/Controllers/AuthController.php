<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show admin login form
     *
     * This function displays the login form for administrators only
     * No customer authentication - customers don't need to login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle admin login
     *
     * This function:
     * 1. Validates admin credentials (email, password)
     * 2. Uses admin guard for authentication
     * 3. Redirects to admin dashboard on success
     *
     * Only for administrators - customers don't login
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'remember' => 'boolean',
        ]);

        // Use admin guard for authentication
        if (Auth::guard('admin')->attempt($validated, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/admin/dashboard')->with('success', 'Welcome back, Admin!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    /**
     * Handle admin logout
     *
     * This function:
     * 1. Logs out the admin user
     * 2. Invalidates the session
     * 3. Redirects to home page
     *
     * Only for administrators
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out successfully.');
    }

    /**
     * Show admin profile
     *
     * This function displays the admin profile page
     * Only accessible to authenticated admins
     */
    public function profile()
    {
        $admin = Auth::guard('admin')->user();
        return view('auth.profile', compact('admin'));
    }

    /**
     * Show edit admin profile form
     *
     * This function displays the form to edit admin profile
     * Only accessible to authenticated admins
     */
    public function editProfile()
    {
        $admin = Auth::guard('admin')->user();
        return view('auth.edit-profile', compact('admin'));
    }

    /**
     * Update admin profile
     *
     * This function:
     * 1. Validates the profile update data
     * 2. Updates the admin profile in database
     * 3. Redirects with success message
     *
     * Only accessible to authenticated admins
     */
    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
        ]);

        $admin->update($validated);

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
    }

    /**
     * Show change password form
     *
     * This function displays the form to change admin password
     * Only accessible to authenticated admins
     */
    public function showChangePassword()
    {
        return view('auth.change-password');
    }

    /**
     * Change admin password
     *
     * This function:
     * 1. Validates current password and new password
     * 2. Checks if current password is correct
     * 3. Updates password in database
     * 4. Redirects with success message
     *
     * Only accessible to authenticated admins
     */
    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($validated['current_password'], $admin->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $admin->update(['password' => Hash::make($validated['password'])]);

        return redirect()->route('admin.profile')->with('success', 'Password changed successfully!');
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{


    public function profile()
    {
        $user = Auth::guard('web')->user();
        return view('user.profile', compact('user'));
    }

    public function settings()
    {
        $user = Auth::guard('web')->user();
        return view('user.settings', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::guard('web')->user();

        $request->validate([
            'fullname' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20|unique:users,phone,' . $user->id,
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'date_of_birth' => 'nullable|date',
            'occupation' => 'nullable|string|max:100',
            'annual_income' => 'nullable|numeric|min:0',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'date_of_birth' => $request->date_of_birth,
            'occupation' => $request->occupation,
            'annual_income' => $request->annual_income,
        ];

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }
            
            // Store new image
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $data['profile_image'] = $imagePath;
        }

        $user->update($data);

        return redirect()->route('user.settings')->with('success', 'Profile updated successfully.');
    }

    public function updateEmail(Request $request)
    {
        $user = Auth::guard('web')->user();

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'email' => $request->email,
        ]);

        return redirect()->route('user.settings')->with('success', 'Email updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::guard('web')->user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('user.settings')->with('success', 'Password updated successfully.');
    }
}
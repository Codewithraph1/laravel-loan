<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('user.auth.login');
    }

    public function showRegistrationForm()
    {
        return view('user.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:100',
            'email' => 'required|email|unique:users|max:150',
            'password' => 'required|min:4|confirmed',
        ]);

        // Generate 11-digit numeric account number
        $accountNumber = $this->generateAccountNumber();

        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => null, // Use NULL instead of empty string
            'password' => Hash::make($request->password),
            'account_number' => $accountNumber,
            'balance' => 0.00,
            'credit_score' => 0,
            'is_verified' => false,
            'status' => 'active',
        ]);

        // Send registration email
        $this->sendRegistrationEmail($user);

        return redirect()->route('user.login')
            ->with('success', 'Registration successful! Please check your email for confirmation.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::guard('web')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Send login notification email
            $this->sendLoginEmail(Auth::guard('web')->user());

            return redirect()->intended('user/dashboard')
                ->with('success', 'Login successful! Welcome back.');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'You have been logged out successfully.');
    }

    /**
     * Generate unique 11-digit numeric account number
     */
    private function generateAccountNumber()
    {
        do {
            // Generate 11 random digits (ensures it's exactly 11 digits)
            $accountNumber = mt_rand(10000000000, 99999999999);
            
            // Check if this account number already exists
            $exists = User::where('account_number', $accountNumber)->exists();
        } while ($exists);

        return (string) $accountNumber;
    }

    private function sendRegistrationEmail($user)
    {
        $data = [
            'name' => $user->fullname,
            'email' => $user->email,
            'account_number' => $user->account_number,
        ];

        Mail::send('user.emails.registration', $data, function($message) use ($user) {
            $message->to($user->email, $user->fullname)
                    ->subject('Welcome to Our Platform - Registration Successful');
        });
    }

    private function sendLoginEmail($user)
    {
        $data = [
            'name' => $user->fullname,
            'login_time' => now()->format('Y-m-d H:i:s'),
            'ip_address' => request()->ip(),
        ];

        Mail::send('user.emails.login', $data, function($message) use ($user) {
            $message->to($user->email, $user->fullname)
                    ->subject('Login Notification - Your Account Was Accessed');
        });
    }
}
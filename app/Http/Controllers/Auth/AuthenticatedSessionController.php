<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        // validated input
        $data = $request->validated();

        $throttleKey = Str::lower($data['email'] ?? $request->input('email')).'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            // Generic throttle message to avoid leaking exact timing
            throw ValidationException::withMessages([
                'email' => [__('auth.throttle')],
            ]);
        }

        if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            RateLimiter::hit($throttleKey, 60);
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($throttleKey);

        $request->session()->regenerate();

        $user = Auth::user();

        // Prevent login if the account is not active — return generic failure to avoid enumeration
        if (! $user->is_active) {
            Auth::guard('web')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        // Redirect admin users to admin dashboard, others to home
        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.users.index'));
        }

        return redirect()->intended(route('home'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

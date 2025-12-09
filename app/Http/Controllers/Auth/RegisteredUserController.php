<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'role' => 'user',
        ]);

        // Ensure 'user' role exists in Spatie and assign to the newly registered user for consistency
        try {
            Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);
            $user->assignRole('user');
        } catch (\Throwable $e) {
            // If Spatie is not configured or something fails, continue without throwing
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home'));
    }
}

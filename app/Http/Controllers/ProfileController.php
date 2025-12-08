<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('client.profile.show');
    }

    public function edit()
    {
        return view('client.profile.edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update($request->only('name', 'email'));

        return redirect()->route('profile.show')->with('success', 'Cập nhật thông tin thành công!');
    }

    public function purchaseHistory()
    {
        // For now, return a placeholder view since no orders system exists yet
        return view('client.profile.purchase-history');
    }
}


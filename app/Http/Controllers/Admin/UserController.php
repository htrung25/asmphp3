<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // enforce admin role without relying on kernel middleware alias
        $this->middleware(function ($request, $next) {
            $user = $request->user();
            if (! $user || ! $user->hasRole('admin')) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function index()
    {
        $users = User::paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function toggleActive(User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();

        return back()->with('success', 'Cập nhật trạng thái thành công!');
    }
    public function destroy(User $user)
    {
        $auth = Auth::user();

        // Prevent admin from deleting themselves
        if ($auth && $auth->id === $user->id) {
            return back()->with('error', 'Bạn không thể xóa chính mình.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Xóa tài khoản thành công!');
    }
}
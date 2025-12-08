<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $users = User::paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function toggleActive(User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();

        return back()->with('success', 'Cập nhật trạng thái thành công!');
    }
}
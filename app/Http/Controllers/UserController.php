<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Aspiration;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->withCount('aspirations')->paginate(5);
        return view('dashboards.users.users', compact('users'));
    }

    public function showReports(User $user)
    {
        $reports = Aspiration::with('user')->where('user_id', $user->id)->latest()->get();
        return view('dashboards.users.user-report', compact('reports', 'user'));
    }
}

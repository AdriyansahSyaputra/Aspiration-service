<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $reports = Aspiration::latest()->take(3)->get();

        return view('dashboards.dashboard', compact('reports'));
    }
}

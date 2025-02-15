<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyReportController extends Controller
{
    public function index()
    {
        // Ambil data aspirations dengan user yang sedang login
        $reports = Aspiration::with('user')->where('user_id', Auth::user()->id)->latest()->paginate(5);
        return view('my-reports.my-reports', ['title' => 'Laporan Saya'], compact('reports'));
    }
}

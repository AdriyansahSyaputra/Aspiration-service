<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter dari request
        $search = $request->input('search');
        $instansi = $request->input('instansi');
        $sort = $request->input('sort', 'terbaru');

        // Query aspirations tanpa eager loading
        $aspirations = Aspiration::when($search, function ($query, $search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('aspiration', 'like', "%{$search}%");
        })
            ->when($instansi, function ($query, $instansi) {
                $query->where('institution', $instansi);
            })
            ->orderBy('created_at', $sort === 'terbaru' ? 'desc' : 'asc')
            ->get();

        return view('explore.explore', [
            'title' => 'Jelajah',
            'aspirations' => $aspirations
        ]);
    }
}

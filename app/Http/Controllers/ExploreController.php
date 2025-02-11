<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function index()
    {
        $aspirations = Aspiration::latest()->get();

        return view('explore.explore', [
            'title' => 'Jelajah',
            'aspirations' => $aspirations
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $aspirations = Aspiration::when($search, function ($query, $search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('aspiration', 'like', "%{$search}%");
        })->get();

        return view('explore.explore', [
            'title' => 'Hasil Pencarian',
            'aspirations' => $aspirations,
        ]);
    }


    public function filter(Request $request)
    {
        $instituion = $request->input('instansi');
        $sort = $request->input('sort', 'terbaru');

        $aspirations = Aspiration::when($instituion, function ($query) use ($instituion) {
            return $query->where('institution', $instituion);
        })->orderBy('created_at', $sort === 'terbaru' ? 'desc' : 'asc')->get();

        return view('explore.explore', [
            'title' => 'Jelajah',
            'aspirations' => $aspirations
        ]);
    }
}

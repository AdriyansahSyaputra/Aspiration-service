<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AspirationRequest;

class AspirationController extends Controller
{
    public function index()
    {
        return view('home.home', [
            'title' => 'Home'
        ]);
    }

    public function store(AspirationRequest $request)
    {
        $validate = $request->validated();

        $customId = Aspiration::generateId();
        
        // Logika pengelolaan file jika ada
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');

            // Validasi tipe file
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
            $maxFileSize = 5 * 1024 * 1024; // 5 MB

            if (!in_array($file->getClientOriginalExtension(), $allowedExtensions)) {
                return back()->with('error', 'File tidak valid. Hanya jpg, jpeg, png, dan pdf yang diizinkan.');
            }

            if ($file->getSize() > $maxFileSize) {
                return back()->with('error', 'Ukuran file maksimal 5 MB.');
            }

            // Simpan file ke direktori storage dengan nama unik
            $attachmentPath = $file->storeAs('attachments', $customId . '.' . $file->getClientOriginalExtension(), 'public');
        }

        Aspiration::create([
            'id' => $customId,
            'title' => $validate['title'],
            'slug' => Aspiration::generateUniqueSlug($validate['title']),
            'institution' => $validate['institution'],
            'aspiration' => $validate['aspiration'],
            'date_occurred' => $validate['date_occurred'],
            'location' => $validate['location'],
            'status' => 'pending',
            'attachment' => $attachmentPath,
            'user_id' => Auth::user()->id
        ]);

        return back()->with('success', 'Aspirasi berhasil dikirim.');
    }
}

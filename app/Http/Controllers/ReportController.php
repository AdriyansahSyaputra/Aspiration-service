<?php

namespace App\Http\Controllers;

use App\Events\ResponseCreated;
use App\Models\Aspiration;
use App\Models\Responses;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Aspiration::with('user')->latest()->paginate(5);
        return view('dashboards.reports.report', compact('reports'));
    }

    public function show(Aspiration $report)
    {
        $report = $report->load('user');
        return view('dashboards.reports.report-detail', compact('report'));
    }

    public function destroy($id)
    {
        $id = Aspiration::find($id);
        $id->delete();
        return redirect()->route('reports')->with('success', 'Laporan berhasil dihapus');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai',
        ]);

        $report = Aspiration::findOrFail($id);
        $report->status = $request->status;
        $report->save();

        return redirect()->route('reports.show', $report->slug)
            ->with('success', 'Status laporan berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'response' => 'required|string',
            'aspiration_id' => 'required|exists:aspirations,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $response = Responses::create($validated);

        event(new ResponseCreated($response));

        return redirect()->route('reports.show', $response->aspiration->slug)
            ->with('success', 'Respon berhasil dikirim');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $reports = Aspiration::with('user')
            ->where('title', 'like', "%{$search}%")
            ->orWhere('id', 'like', "%{$search}%") 
            ->orWhere('institution', 'like', "%{$search}%") 
            ->orWhereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->get();

        return view('dashboards.reports.report', compact('reports'));
    }

    public function filter(Request $request)
    {
        $status = $request->input('status');

        $reports = Aspiration::when($status, function ($query) use ($status) {
            return $query->where('status', $status);
        })->get();

        return view('dashboards.reports.report', compact('reports'));
    }
}

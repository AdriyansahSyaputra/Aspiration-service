<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Aspiration::with('user')->latest()->get();
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
}

<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // 1. Mostrar todos los reportes (SOLO ADMIN)
    public function index()
    {
        // Traemos todos los reportes con los datos del usuario y el libro afectado
        $reports = Report::with(['user', 'book'])->orderBy('created_at', 'desc')->get();
        return view('reports.index', compact('reports'));
    }

    // 2. Guardar un reporte desde la vista del libro (USUARIOS)
    public function store(Request $request, $book_id)
    {
        $request->validate([
            'issue_type' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        Report::create([
            'user_id' => Auth::id(),
            'book_id' => $book_id,
            'issue_type' => $request->issue_type,
            'description' => $request->description,
            'status' => 'pending' // Entra como 'pendiente'
        ]);

        return back()->with('success', 'SYS_ALERT_SENT: Tu reporte ha sido enviado al equipo técnico.');
    }

    // 3. Actualizar el estado del reporte (SOLO ADMIN)
    public function update(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,resolved,dismissed'
        ]);

        $report->update(['status' => $request->status]);

        return back()->with('success', 'LOG_UPDATED: El estado del reporte ha sido cambiado.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\DownloadLog;
use App\Models\BookRequest;
use App\Models\Report;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Contadores Generales
        $totalBooks = Book::count();
        $totalUsers = User::count();
        $totalDownloads = DownloadLog::count();
        
        // 2. Tareas Pendientes (Alertas para el Admin)
        $pendingRequests = BookRequest::where('status', 'pending')->count();
        $pendingReports = Report::where('status', 'pending')->count();

        // 3. Top 5 Libros Más Descargados 
        $topBooks = Book::withCount('downloadLogs')
                        ->orderBy('download_logs_count', 'desc')
                        ->take(5)
                        ->get();

        return view('admin.dashboard', compact(
            'totalBooks', 'totalUsers', 'totalDownloads', 
            'pendingRequests', 'pendingReports', 'topBooks'
        ));
    }
}
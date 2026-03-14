<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // 1. Mostrar lista de usuarios
    public function index()
    {
        // Traemos todos los usuarios, ordenados por los más recientes
        $users = User::orderBy('created_at', 'desc')->get();
        return view('users.index', compact('users'));
    }

    // 2. Cambiar el rol de un usuario
    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Medida de seguridad: Evitar que el admin se quite sus propios poderes por accidente
        if (Auth::id() == $id) {
            return back()->with('error', 'OPERATION_DENIED: No puedes cambiar tu propio nivel de acceso.');
        }

        $request->validate([
            'role' => 'required|in:lector,bibliotecario'
        ]);

        $user->update(['role' => $request->role]);

        return back()->with('success', 'ACCESS_LEVEL_UPDATED: Privilegios de usuario modificados.');
    }

    // 3. Eliminar un usuario
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Medida de seguridad: Evitar que el admin se borre a sí mismo
        if (Auth::id() == $id) {
            return back()->with('error', 'OPERATION_DENIED: No puedes purgar tu propia cuenta.');
        }

        $user->delete();

        return back()->with('success', 'USER_PURGED: La cuenta ha sido eliminada del sistema.');
    }
}

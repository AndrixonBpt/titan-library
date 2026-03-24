<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Importante para crear usuarios
use Illuminate\Support\Facades\Hash; // Importante para encriptar contraseñas

class AuthController extends Controller
{
    // --- LOGIN  ---
    
    public function showLogin() {
        return view('login');
    }

    public function login(Request $request) {
        // Validación Login 
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Introduce un correo válido.',
            'password.required' => 'La contraseña es obligatoria.'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('sistema');
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas (o usuario no existe).']);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // --- REGISTRO ---

    // 1. Mostrar Formulario
    public function showRegister() {
        return view('register');
    }

    // 2. Procesar Registro
    public function register(Request $request) {
        // Validaciones
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', 
            'password' => 'required|string|min:8|confirmed', // 'confirmed' busca password_confirmation
        ], [
            // MENSAJES DE ERROR PERSONALIZADOS 
            'name.required' => 'El nombre clave es obligatorio.',
            'email.required' => 'El correo es obligatorio.',
            'email.unique' => 'Este correo ya está registrado en el sistema.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.', 
        ]);

        // Crear Usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'lector' // Por defecto siempre es lector
        ]);

        // Autologin inmediato (iniciar sesión automáticamente)
        Auth::login($user);

        return redirect()->route('library.index');
    }
}

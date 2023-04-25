<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomLoginController extends Controller
{
    //
    public function login(Request $r)
    {
        $credentials = $r->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->active === 0) {
                Auth::logout();
                return redirect("/login")->withErrors(['active' => ["El usuario no ha sido activado aún. Por favor contacte al administrador."]]);
            }
            // Authentication passed...
            return redirect("/nova");
        }

        return redirect("/login")->withErrors(['credenciales' => ["Credenciales incorrectas"]]);
    }
}

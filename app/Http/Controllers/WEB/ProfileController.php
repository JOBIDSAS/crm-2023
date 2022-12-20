<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile_page()
    {
        return view('web.connexion.profile');
    }
    public function déconnexion()
    {
        Auth::logout();
        return redirect('/');
    }
}

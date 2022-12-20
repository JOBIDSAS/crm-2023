<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login_page()
    {
        return view('web.connexion.login');
    }

    public function trait_login()
    {
        request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $resultat = Auth::attempt([
            'email' => request('email'),
            'password' => request('password'),
        ]);
        if ($resultat) {
            return redirect('/profile');
        }
        return back()->withInput()->withErrors([
            'email' => 'Vos identifiants sont incorrects',
        ]);
    }
//    protected function redirectTo(){
//        $user = auth()->user();
//
//        switch ($user->role) {
//            case "tpe":
//
//                return route("web.entrepris.tpe_pme");
//                break;
//            case "ag":
//                return route("web.entrepris.agence");
//                break;
//            case "col":
//                return route("web.entrepris.collectivités");
//                break;
//            default:
//                return route("/");
//        }
//    }
    //GoogleLogin
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    //GoogleCallback
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $this->trait_login($user);
        return redirect('/home');
    }

    //Facebooklogin
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    //Facebook  Callback
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        $this->trait_login($user);
        return redirect()->route('home');
    }

    //linkedin login
    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    //linkedin  Callback
    public function handleLinkedinCallback()
    {
        $user = Socialite::driver('linkedin')->user();

        $this->trait_login($user);
        return redirect()->route('home');
    }

}

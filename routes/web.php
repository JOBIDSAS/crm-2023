<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CRM\RoutesController;
use App\Http\Controllers\CRM\SignController;
use App\Http\Controllers\CRM\TestController;
use App\Http\Controllers\CRM\CalendarController;
use App\Http\Controllers\CRM\ProfileController;
use App\Http\Controllers\CRM\LeadsController;

use App\Http\Controllers\WEB\MailController;
use App\Http\Controllers\WEB\LoginController;
use App\Http\Controllers\WEB\ProfileController as WebProfileController;
use App\Http\Controllers\WEB\RegisterController;
use App\Http\Controllers\WEB\VerifiedController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(["domain" => "cpn-aide-aux-entreprises.com"],function(){
    
    Route::get("", function () {
        return view("web.index");
    });
    Route::get("/home", function () {
        return view("web.home");
    })->name('home');

    Route::get("actuality", function () {
        return view("web.actuality");
    })->name('actuality');

    Route::get("agenda", function () {
        return view("web.agenda");
    })->name('agenda');

    Route::get("calendar", function () {
        return view("web.calendar");
    })->name('calendar');

    Route::get("contact", function () {
        return view("web.contact");
    })->name('contact');

    Route::get("about", function () {
        echo "about";
    })->name('about');

    Route::get("login", [LoginController::class,"login_page"])->name('login');
    Route::post("connexion_trait", [LoginController::class,'trait_login'])->name('connexion_trait');

    Route::get("registre", [RegisterController::class,'reg_page'])->name('registre');
    Route::post("registre_trait", [RegisterController::class,'trait_reg'])->name('registre_trait');

    Route::get('subevention', function () {
        return view('web.subvention');
    })->name('subevention');

    Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback']);


    Route::get('login/facebook', [LoginController::class, 'redirectToFacebook'])->name('login.facebook');
    Route::get('login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);


    Route::get('login/linkedin', [LoginController::class, 'redirectToLinkedin'])->name('login.linkedin');
    Route::get('login/linkedin/callback', [LoginController::class, 'handleLinkedinCallback']);


    Route::get('profile', [ProfileController::class, 'profile_page'])->name('profile_page');

    Route::get('edit_profile',function (){
        return view('web.connexion.edit_profile');
    });
    
    Route::get('testemail',[VerifiedController::class,"sendSignupEmail"]);

    Route::get('déconnexion', [ProfileController::class, 'déconnexion'])->name('déconnexion');

    Route::get('a_propos', function () {
        return view('web.about_us');
    })->name('a_propos');

    Route::get('map', function () {
        return view('web.map');
    });

    Route::get('pop',function ()
    {
        return view('web.popup');
    });

    Route::get('mot_passe_oubliee',function (){
        return view('web.forgot_p');
    });

    Route::prefix("mail")->group(function(){
        Route::get("confirm/{token}/{cid}", [MailController::class,"confirmMeet"]);
        Route::get("change/{token}", [MailController::class,"changeMeet"]);
        Route::get("change/events/all", [MailController::class,"getCalendarEvents"]);
        Route::post("change/events/update", [MailController::class,"updateCalendarEvent"]);
    });
});



Route::group(['domain' => 'crm.cpn-aide-aux-entreprises.com'],function(){
    Route::get("{slug}", [RoutesController::class,"checkRoutes"])->where("slug",".*");
});
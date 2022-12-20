<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRM\SignController;
use App\Http\Controllers\CRM\TestController;
use App\Http\Controllers\CRM\LeadsController;
use App\Http\Controllers\CRM\ProfileController;
use App\Http\Controllers\CRM\CalendarController;
use App\Http\Controllers\CRM\ClientsController;
use App\Http\Controllers\CRM\ArticlesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// api pour obtenir le liste des clients selon l'utilisateur
Route::get("clients/get", [ClientsController::class, "getClients"]);
//api pour sauvegarder les avis de client .
Route::post("avis/save", [ClientsController::class, "clientAvis"]);


// api pour obtenir les liste des utilisateurs
Route::middleware(["auth:api"])->group(function(){
Route::get("users/get",[ProfileController::class, "getUsers"]);

});
//api pour get,add,delete,edit un article dans le site cpn
Route::get("articles/get",[ArticlesController::class, "getArticles"]);
Route::post("articles/add",[ArticlesController::class, "addArticle"]);
Route::get("articles/delete/{id}",[ArticlesController::class, "DeleteArticle"]);
Route::post("articles/edit",[ArticlesController::class, "EditArticle"]);


// les api pour valider et supprimer les utilisateurs
Route::get("users/delete/{id}",[ProfileController::class, "DeleteUser"]);
Route::get("users/Valid/{id}",[ProfileController::class, "ValidUser"]);
Route::get("users/lead/{id}",[ProfileController::class, "DeleteUserlead"]);
Route::post("repertoir/simple-excel/import", [ClientsController::class, 'import'])->name('excel.import');

//api pour l'authentification et l'inscription
Route::prefix("sign")->group(function(){
  Route::post("in",[SignController::class,"signIn"]);
  Route::post("up",[SignController::class,"signUp"]);
  Route::middleware(['auth:api'])->get('data', [SignController::class,"signData"]);
  Route::middleware(['auth:api'])->get('out',  [SignController::class,"signOut"]);
});

Route::middleware(["auth:api"])->group(function(){
    //api pour obtenir la  liste de reperatoir (client)
    Route::get("reperatoir/get", [ClientsController::class, "getrepreratoir"]);
    //api pour sauvegarder un client dans le repertoir
    Route::post("reperatoir/save", [ClientsController::class, "addrepartoir"]);

 //les api de test d'égiblité
  Route::prefix("test")->group(function(){

    // api pour optenir tous les activités
    Route::get("activities/get",[TestController::class,"activitiesGet"]);
    //api pour obtenir toutes les transitions (services)
    Route::get("transitions/get", [TestController::class,"transitionsGet"]);
    // api pour obtenir les date des rendez-vous
    Route::get("events/get", [TestController::class,"eventsGet"]);
    //api pour ajouter un render-vous
    Route::post("events/add",[TestController::class,"eventsAdd"]);
    //api pour trouver l'id de chiffre d'affaire
    Route::get("service/turnover/{min}/{max}", [TestController::class,"serviceTurnover"]);
    // api pour obtenir les info de la societe a partir de code sirene
    Route::get("company/siren/{siren}",[TestController::class,"comapnySiren"]);
    // api pour sauvegarder un client
    Route::post("contact/save",[TestController::class,"saveContact"]);
    // api pour confirmer les contacts
    Route::post("contact/confirm",[TestController::class,"confirmContact"]);
    // api pour generer un lien zoom
    Route::post("zoom/generate",[TestController::class,"generateZoom"]);

    Route::prefix("grants")->group(function(){
        // api pour obtenir le prix final de test d'egiblité
        Route::get("cpn/{service}/{budget}",[TestController::class,"cpnGrant"]);
        //api pour tester l'egiblité de region
        Route::get("region/{region}/{budget}/{naf}",[TestController::class,"regionGrant"]);
    });

    Route::post("timer/save", [TestController::class, "saveTimer"]);

  });

  Route::prefix("leads")->group(function(){

    // obtenir tous les client selon l'utilisateur
    Route::get("contacts/all",[LeadsController::class,"getLeadsList"]);
    // obtenir un client selon l'id
    Route::get("contacts/{cid}",[LeadsController::class,"getLeadContact"]);
    // renvoyer l'email de teste d'egibilité
    Route::post("email/resend",[LeadsController::class,"resendMail"]);

  });

  Route::prefix("calendar")->group(function(){
      //obtenir les dates de rendez-vous
    Route::get("events/get",[CalendarController::class,"getEvents"]);
  });

  Route::prefix("profile")->group(function(){
    Route::post("image/save",[ProfileController::class, "saveImage"]);
  });

  Route::prefix("supervisor")->group(function(){
      //api pour obtenir les dates des render-vous
    Route::get("calendar/events", [CalendarController::class,"getEvents"]);
    // api pour obtenir la liste de client selon l'utilisateur
    Route::get("clients/get", [ClientsController::class, "getClients"]);
    Route::get("clients/simple-excel/export", [ClientsController::class, 'export'])->name('excel.export');
  });

    Route::get("ring/get",[TestController::class,"ring"]);

});





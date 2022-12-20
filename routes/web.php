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




    Route::get("/", [RoutesController::class,"checkRoutes"]);

<?php

namespace App\Http\Controllers\CRM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RoutesController extends Controller
{
    public function checkRoutes(Request $request)
    {
        return view('crm.app');
    }
}

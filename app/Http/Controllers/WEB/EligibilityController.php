<?php

namespace App\Http\Controllers\WEB;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EligibilityController extends Controller
{
    public function index()
    {
        return view("pages.eligibility");
    }
}

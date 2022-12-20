<?php

namespace App\Http\Controllers\WEB;

use App\Mail\WEB\SignupMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class VerifiedController extends Controller
{
    public function sendSignupEmail()
    {
        $data =
            [
                "email"=>"ghaziarfaa@gmail.com",
                'first_name' => "Ghaziarfa",
                'verification_code'=>"zdqsdsqd"
            ];
        Mail::send(new SignupMail());
    }//
}

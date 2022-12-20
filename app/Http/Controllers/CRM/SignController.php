<?php

namespace App\Http\Controllers\CRM;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OauthAccessTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\TokenRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\RefreshTokenRepository;

class SignController extends Controller
{
    public function signIn(Request $request)
    {
        $validator = Validator::make( $request->all(),[
            "email" => "bail|required|email",
            "password" => "bail|required|min:6"
        ],[
            "email.required" => "Email est requis",
            "email.email" => "Email n'est pas valide",
            "password.required" => "Mot de passe est requis",
            "password.min" => "Mot de passe doit comporter au moins :min caractères.",
        ]);

        if($validator->fails()) return response()->json(["error"=>true,"message"=>$validator->errors()->first()]);
        if(Auth::attempt(["email"=>$request->email,"password"=>$request->password])){
            $user = User::find(Auth::id());
            if ($user->authorized == 0 ){
                return response()->json(["error"=>true,"message"=>"vous etes pas autorisés "]);

            }
            $level = $user->level->name;
            $token = $user->createToken('PersonalAccessToken')->accessToken;
            return response()->json(["error"=>false,"message"=>"Connecté avec succès","user"=>Auth::user(),"token"=>$token,"level"=>$level]);

        } else {
            return response()->json(["error"=>true,"message"=>"Email ou mot de passe incorrect"]);
        }
    }

    public function signUp(Request $request)
    {
        $validator = Validator::make( $request->all(),[
            "firstname" => "bail|required|min:3",
            "lastname" => "bail|required|min:3",
            "email" => "bail|email|required",
            "password" => "bail|required|min:6",
            "level" => "bail|required"
        ],[
            "firstname.required" => "Prénom est requis",
            "firstname.min" => "Prénom doit comporter au moins :min caractères.",
            "lastname.required" => "Nom de famille est requis",
            "lastname.min" => "Nom de famille doit comporter au moins :min caractères.",
            "email.required" => "Email est requis",
            "email.email" => "Email n'est pas valide",
            "level.required" => "Vous devez choisir un type de profile",
            "password.required" => "Mot de passe est requis",
            "password.min" => "Le mot de passe doit comporter au moins :min caractères.",
        ]);

        if($validator->fails()) return response()->json(["error"=>true,"message"=>$validator->errors()->first()]);

        if(User::where("email", $request->email)->first()){
            return response()->json(["error"=>true,"message"=>"Email déjà existant"]);
        }

        try {
            $user = new User();
            $user->first_name = $request->firstname;
            $user->levels_id = $request->level;
            $user->last_name = $request->lastname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            //event(new Registered($user));
        } catch (QueryException $qe) {
            return response()->json(["error"=>true,"message"=>$qe]);
        }

        return response()->json(["error"=>false,"message"=>"Compte créer avec succès"]);

    }

    public function signData()
    {
        $user = User::find(Auth::id());
        $level = $user->level->name;
        return response()->json(["user"=>$user,"level"=>$level]);
    }

    public function signOut(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(["error"=>false,"message"=>"logout"]);
    }

    public function forgot(Request $request)
    {

    }

    public function signVerify(Request $request)
    {

    }
}

<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Contacts;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function saveImage(Request $request)
    {
        return response()->json($request->all());
    }
    public function getUsers(){
        if (Auth::id() == 2) {

        $user = User::orderby("id","desc")->get();
        return response()->json(["users"=>$user]);}
    }
public function DeleteUser($id){
    try {
    User::where("id",$id)->delete();

        return response()->json(["error"=>false,"message"=>"Utilisateur supprimé avec succès"]);
    }
    catch (QueryException $qe) {
        return response()->json(["error"=>true,"message"=>$qe]);
    }

    }

    public function DeleteUserlead($id){
        try {
            contacts::where("users_id",$id)->delete();

            return response()->json(["error"=>false,"message"=>"leads supprimé avec succès"]);
        }
        catch (QueryException $qe) {
            return response()->json(["error"=>true,"message"=>$qe]);
        }

    }

    public function ValidUser($id){

        try {
            $user =  User::where("id",$id)->first();
            $user->authorized = 1;
            $user->update();
            return response()->json(["error"=>false,"message"=>"Utilisateur Validé avec succès"]);
        }
        catch (QueryException $qe) {
            return response()->json(["error"=>true,"message"=>$qe]);
        }

    }


}

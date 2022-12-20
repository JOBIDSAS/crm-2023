<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\articles;

class ArticlesController extends Controller
{
    //
    public function getArticles()
    {
        $articles = articles::orderby("id", "desc")->get();
        return response()->json(["articles" => $articles]);
    }
    public function addArticle(Request $request){

        $avisc = new articles();

        $avisc->titre = $request->titre;
        $avisc->soustitre = $request->soustitre;
        $avisc->desc = $request->desc;
        $filename = $request->image->getClientOriginalName();
        $request->image->storeAs('images', $filename, 'public');
        $path = public_path('img/');
        $request->image->move($path,$filename);
        $avisc->image = $filename;
        $avisc->save();
        return response()->json(["error" => false, "message" => "Article ajouté avec succès"]);
    }

    public function DeleteArticle($id){
        try {
            articles::where("id",$id)->delete();

            return response()->json(["error"=>false,"message"=>"Article supprimé avec succès"]);
        }
        catch (QueryException $qe) {
            return response()->json(["error"=>true,"message"=>$qe]);
        }

    }

}

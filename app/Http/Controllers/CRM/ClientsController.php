<?php

namespace App\Http\Controllers\CRM;

use App\Models\Calendar;
use App\Models\Client;
use App\Models\Contacts;
use App\Models\repartoir;
use App\Models\avisclient;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CRM\Leads\LeadContactsResources;
use Illuminate\Support\Facades\DB;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;

class ClientsController extends Controller
{
    public function getClients()
    {
        $user = User::where("id",Auth::id())->first();
        if (Auth::id() == 2) {

            $leads = Contacts::orderByDesc('id')->get();
            $leads = LeadContactsResources::collection($leads);
            return response()->json(["leads"=>$leads]);
        }

        else if ($user->levels_id == 5 ){
            $leads=    DB::table('calendar_events')
                ->join('contacts', 'contacts.id', '=', 'calendar_events.contacts_id')
                ->where('calendar_events.confirmed', 0)
                ->get();
            $leads = LeadContactsResources::collection($leads);
            return response()->json(["leads"=>$leads]);}


        else {
        $leads = Contacts::where("users_id",Auth::id())->orderby("id","desc")->get();
        $leads = LeadContactsResources::collection($leads);
        return response()->json(["leads"=>$leads]);}
    }

    public function getrepreratoir()
    {
        if (Auth::id() == 2) {
        $data = repartoir::get();}
        else {
            $data = repartoir::where("users_id",Auth::id())->orderby("id","desc")->get();
        }
        return response()->json([
            "data"=>$data
        ],200);
    }
    public function addrepartoir(Request $request)
    {

        $avisc = new repartoir();
        $avisc->prenon = $request->prenon;
        $avisc->email = $request->email;
        $avisc->phone = $request->phone;
        $avisc->nom = $request->nom;
        $avisc->commentaire = $request->commentaire;
        $avisc->status = $request->status;
        $avisc->datetime = $request->datetime;
        $avisc->users_id = Auth::id();
        $avisc->save();
        $calendar = new Calendar();
        $calendar->users_id = Auth::id();
        $calendar->contacts_id = null;
        $calendar->title = $request->prenon." ".$request->nom;
        $calendar->date = gmdate("Y-m-d H:i:s",strtotime($request->datetime));
        $calendar->description = $request->prenon." ".$request->nom;
        $calendar->color = "gray";
        $calendar->save();

    }

    public function clientAvis(Request $request)
    {
        $avisc = new avisclient();
        $avisc->username = $request->username;
        $avisc->email = $request->email;
        $avisc->phone = $request->phone;
        $avisc->site = $request->site;
        $avisc->message = $request->message;
        $avisc->finance = $request->finance;
        $avisc->note = $request->note;
        $avisc->buget = $request->buget;
        $avisc->comment = $request->comment;
        $avisc->proj = $request->proj;
        $avisc->save();

        $contactForm = array();
        $contactForm["title"] = $request->username;
        $contactForm["priority"] ="Normale";
        $contactForm["company_id"] = 0;
        $contactForm["project_id"] = 0;
        $contactForm["description"] = "<p style=\"font-family: 'Lucida Grande', Verdana, Arial, Helvetica, sans-serif; font-size: 13.3333px;\"></p>\r\n<p style=\"font-family: 'Lucida Grande', Verdana, Arial, Helvetica, sans-serif; font-size: 13.3333px;\">&nbsp;</p>\r\n\r\n<p style=\"font-family: 'Lucida Grande', Verdana, Arial, Helvetica, sans-serif; font-size: 13.3333px;\"> $request->comment</p>";


        $contactForm["custom_fields"] = [
            "email" => $request->email,
            "phone" => $request->phone,
            "site" => $request->site,
            "Username" => $request->username,
            "financement attribuer par le CPN" => $request->finance,
            "note" => $request->note,
            "adaptable à votre Budget" => $request->buget,
//            "Date Zoom" => $request->comment,
            "Projet" => $request->proj,
        ];

        $headers = array(
            "userApiKey: aa77431de31ef7103de3f2c521c51e06",
            "content-type: application/json",
            "Accept: application/json",
        );

        $encodeData = json_encode($contactForm);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://axonaut.com/api/v2/tickets",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $encodeData,
            CURLOPT_HTTPHEADER => $headers,
        ));

        $result = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);


        if (!$result)
        {
            return response()->json(["error"=>true,"message"=>$err]);
        }
        return response()->json(json_decode($result));

    }



    public function export(Request $request)
    {

        // 1. Validation des informations du formulaire


        // 2. Le nom du fichier avec l'extension : .xlsx ou .csv
        $file_name = "Client.xlsx";

        // 3. On récupère données de la table "clients"
        $clients = Contacts::select("first_name", "last_name", "email", "confirmed")->get();

        // 4. $writer : Objet Spatie\SimpleExcel\SimpleExcelWriter
        $writer = SimpleExcelWriter::streamDownload($file_name);

        // 5. On insère toutes les lignes au fichier Excel $file_name
        $writer->addRows($clients->toArray());

        // 6. Lancer le téléchargement du fichier
        $writer->toBrowser();

    }


    public function import(Request $request)
    {

        // 1. Validation du fichier uploadé. Extension ".xlsx" autorisée
        $this->validate($request, [
            'fichier' => 'bail|required|file|mimes:xlsx'
        ]);

        // 2. On déplace le fichier uploadé vers le dossier "public" pour le lire
        $fichier = $request->fichier->move(public_path(), $request->fichier->hashName());

        // 3. $reader : L'instance Spatie\SimpleExcel\SimpleExcelReader
        $reader = SimpleExcelReader::create($fichier);

        // On récupère le contenu (les lignes) du fichier
        $rows = $reader->getRows();

        // $rows est une Illuminate\Support\LazyCollection

        // 4. On insère toutes les lignes dans la base de données
        $status = repartoir::insert($rows->toArray());

        // Si toutes les lignes sont insérées
        if ($status) {

            // 5. On supprime le fichier uploadé
            $reader->close(); // On ferme le $reader
            unlink($fichier);

            // 6. Retour vers le formulaire avec un message $msg
            return back()->withMsg("Importation réussie !");

        } else {
            abort(500);
        }
    }
}

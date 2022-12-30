<?php

namespace App\Http\Controllers\CRM;

use App\Models\Calendar;
use App\Models\Contacts;
use Firebase\JWT\JWT;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Verifications;
use App\Mail\CRM\EligibilityMailre;
use PHPMailer\PHPMailer\Exception;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\CRM\Leads\LeadContactsResources;

class LeadsController extends Controller
{
    public function getLeadsList(Request $request)
    {
        if (Auth::id() == 2) {
            $leads = Contacts::orderByDesc('id')->get();;
            $leads = LeadContactsResources::collection($leads);
            return response()->json(["leads"=>$leads]);
        }
        else {
        $leads = Contacts::where("users_id",Auth::id())->orderby("id","desc")->get();
        $leads = LeadContactsResources::collection($leads);
        return response()->json(["leads"=>$leads]);}
    }

    public function getLeadContact($cid)
    {
        $leads = Contacts::where("id",$cid)->first();
        //$leads = ContactsLeadsResources::collection($leads);
        return response()->json(["leads"=>$leads]);
    }

    public function resendMail(Request $request)
    {
        if ($request->contact["datetime"] == null){
            return response()->json(["error"=>false,"message"=>"Vous devez choisir une date"]);
        }
        else {
        $zoom = [
            "start_time" => $request->contact["datetime"],
            "uuid" => $request->meeting["id"],
            "join_url" => $request->meeting["link"],
            "password" => $request->meeting["password"],
        ];
        $cid = $request->contact["id"];
        $grant = $request->eligibility["cpn"];
        $company = $request->company["name"];
        $email = $request->contact["email"];
        $token = $this->mailAccesCode();
        $eventData = Calendar::where("contacts_id",$cid)->first();
        $eventData->date = $request->contact["datetime"];
        $eventData->update();
        $this->getZoomLink($eventData);
        try{
            Mail::send( new EligibilityMailre($zoom, $cid, $grant, $company, $email, $request->contact["datetime"], $token) );
            return response()->json(["error"=>false,"message"=>"Email renvoyé avec succès"]);
        } catch(Exception $e) {
            return response()->json(["error"=>true,"message"=>$e]);
        }
    }}

    public function getZoomLink($event)
    {
        $createMeeting = array();
        $createMeeting["topic"] = $event->title.", Rendez-vous Avec votre conseiller Numerique Pour votre projet";
        $createMeeting["type"] = 2;
        $createMeeting["start_time"] = gmdate("Y-m-d\TH:i:s",strtotime($event->date));
        $createMeeting["duration"] = 60;
        $createMeeting["timezone"] = "";
        $createMeeting["password"] = "";
        $createMeeting["agenda"] = "";
        $createMeeting["settings"] = array(
            "host_video"=>true,
            "participant_video"=>true,
            "join_before_host"=>true,
            "mute_upon_entry"=>false,
            "enforce_login"=>false,
            "auto_recording"=>"local",
            "alternative_hosts"=>"",
        );

        $token = array(
            "iss" => env("ZOOM_CLIENT_KEY"),
            "exp" => time() + 3600 //60 seconds as suggested
        );
        $getJWTKey = JWT::encode($token, env("ZOOM_CLIENT_SECRET"));
        $headers = array(
            "authorization: Bearer ".$getJWTKey,
            "content-type: application/json",
            "Accept: application/json",
        );

        $encodeData = json_encode($createMeeting);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env("ZOOM_API_LINK"),
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
            return ["error"=>true,"message"=>$err];
        }
        return json_decode($result);
    }

    public function mailAccesCode()
    {
        $verification = new Verifications();
        $verification->type = "eligibility";
        $verification->code = Str::random(32);
        $verification->save();
        return $verification->code;
    }
    public function changetat (Request $request){

        $leads = Contacts::where("id",$request->id)->first();
        $leads->etat = $request->etat;
        $leads->update();
        return response()->json(["leads"=>$leads]);

    }
}

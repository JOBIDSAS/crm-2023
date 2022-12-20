<?php

namespace App\Http\Controllers\CRM;

use App\Models\Calendar;
use App\Models\Contacts;
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

        $eventData = Calendar::where("contacts_id",$cid)->where("users_id",Auth::id())->first();

        try{
            Mail::send( new EligibilityMailre($zoom, $cid, $grant, $company, $email, $request->contact["datetime"], $token) );
            return response()->json(["error"=>false,"message"=>"Email renvoyé avec succès"]);
        } catch(Exception $e) {
            return response()->json(["error"=>true,"message"=>$e]);
        }
    }

    public function mailAccesCode()
    {
        $verification = new Verifications();
        $verification->type = "eligibility";
        $verification->code = Str::random(32);
        $verification->save();
        return $verification->code;
    }
}

<?php

namespace App\Http\Controllers\CRM;

use Firebase\JWT\JWT;
use App\Models\Counter;
use App\Models\Regions;
use App\Models\Calendar;
use App\Models\Contacts;
use App\Models\Meetings;
use App\Models\Addresses;
use App\Models\Companies;
use App\Models\Turnovers;
use App\Models\Activities;
use App\Models\Eligibility;
use App\Models\Investments;
use App\Models\RegionsNafs;
use App\Models\Transitions;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Developements;
use App\Models\Verifications;
use App\Models\RegionsVouchers;
use App\Mail\CRM\EligibilityMail;
use App\Models\TransitionsGrants;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;
use App\Http\Resources\TurnoversResources;
use App\Http\Resources\TransitionsResources;

class TestController extends Controller
{
    public function activitiesGet()
    {
        $data = Activities::get();
        return response()->json([
            "data"=>$data
        ],200);
    }

    public function transitionsGet()
    {
        $data = Transitions::get();
        $data = TransitionsResources::collection($data);
        return response()->json([
            "data"=>$data
        ],200);
    }

    public function serviceTurnover($min,$max)
    {
        $data = Turnovers::where("min","<=",$min)->where("max",">=",$max)->first();
        $data = TurnoversResources::make($data);
        return response()->json([
            "data"=>$data
        ],200);
    }

    public function comapnySiren($siren)
    {
        $headers = array(
            "content-type: application/json",
            "Accept: application/json",
        );

        $comapnyInfo = curl_init();
        curl_setopt_array($comapnyInfo, array(
            CURLOPT_URL => "https://api.societe.com/pro/dev/societe/".$siren."?token=59a836cb792a3e983c5b3ae5277c0b5b",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => $headers,
        ));
        $resultCompany = curl_exec($comapnyInfo);
        $errCompany = curl_error($comapnyInfo);
        curl_close($comapnyInfo);

        if (!$resultCompany)
        {
            return json_encode(["error"=>true,"message"=>$errCompany]);
        }

        return $resultCompany;
    }

    public function cpnGrant($service,$budget)
    {
        $data = TransitionsGrants::where("transitions_id",$service)->where("budget","<=",$budget)->orderBy("budget","desc")->first();
        return response()->json($data);
    }

    public function regionGrant($region,$budget,$naf)
    {
        $regionRes = Regions::where("name","like",$region."%")->first();
        if(!$regionRes) return response()->json(["eligible"=>false,"step"=>"region","message"=>"region n'existe pas"]);
        
        $nafRes = RegionsNafs::where("regions_id",$regionRes->id)->where("code",$naf)->first();
        if($nafRes && $nafRes->excluded == 1) if($nafRes) return response()->json(["eligible"=>false,"step"=>"naf","message"=>"code naf est exclus"]);
        
        $voucherRes = RegionsVouchers::where("regions_id",$regionRes->id)->where("min","<=",$budget)->first();
        if(!$voucherRes) return response()->json(["eligible"=>false,"step"=>"amount","message"=>"budget investi faible"]);
        if($budget>=$voucherRes->max) return response()->json(["eligible"=>true,"step"=>"voucher","id"=>$voucherRes->id,"voucher"=>$voucherRes->name,"message"=>"éligible","amount"=>$voucherRes->amount,"region"=>Regions::where("id",$voucherRes->regions_id)->pluck("name")->first()]);
        else return response()->json(["eligible"=>true,"step"=>"voucher","id"=>$voucherRes->id,"message"=>"éligible","voucher"=>$voucherRes->name,"amount"=>($budget * $voucherRes->refund)/100,"region"=>Regions::where("id",$voucherRes->regions_id)->pluck("name")->first()]); 
    }

    public function saveContact(Request $request)
    {
        $contactsData = $request->contacts;
        $companiesData = $request->companies;
        $addressData = $request->address;
        $developmentData = $request->development;
        $investmentData = $request->investment;

        $contact = new Contacts();
        $contact->users_id = Auth::id();
        $contact->first_name = $contactsData["firstName"];
        $contact->last_name = $contactsData["lastName"];
        $contact->email = $contactsData["email"];
        $contact->phone = $contactsData["phone"];
        $contact->position = $contactsData["position"];
        $contact->lead = 1;
        $contact->save();

        $company = $this->setCompany($contact->id,$companiesData);
        $investment = $this->setInvestment($contact->id,$investmentData);
        $address = $this->setAddress($contact->id,$addressData);
        $development = $this->setDevelopment($contact->id,$developmentData);

        return response()->json(["error"=>false,"message"=>"Contact sauvegardé avec succès","cid"=>$contact->id]);
        
    }

    public function setCompany($CID,$companyData)
    {
        $company = new Companies();
        $company->contacts_id = $CID;
        $company->activities_id = $companyData["activity"];
        $company->name = $companyData["name"];
        $company->status = $companyData["status"];
        $company->salaries = $companyData["salaries"];
        $company->siret = $companyData["siret"];
        $company->siren = $companyData["siren"];
        $company->naf = $companyData["naf"];
        $company->phone = $companyData["phone"];
        $company->turnover = $companyData["turnover"];
        $company->turnovers_id = $companyData["lastTurnover"];
        $company->state_help = $companyData["help"];
        $company->save();
        return true;
    }

    public function setInvestment($CID,$investmentData)
    {
        $investment = new Investments();
        $investment->contacts_id = $CID;
        $investment->service_id = $investmentData["service"];
        $investment->transitions = implode(", ",$investmentData["digitalTransitions"]);
        $investment->budget = $investmentData["budget"];
        $investment->save();
        return true;
    }

    public function setAddress($CID,$addressData)
    {
        $address = new Addresses();
        $address->users_id = Auth::id();
        $address->contacts_id = $CID;
        $address->address = $addressData["line"];
        $address->region = $addressData["region"];
        $address->city = $addressData["city"];
        $address->zipcode = $addressData["zipcode"];
        $address->department = $addressData["departement"];
        $address->country = $addressData["country"];
        $address->save();
        return true;
    }

    public function setDevelopment($CID,$developmentData)
    {
        $development = new Developements();
        $development->contacts_id = $CID;
        $development->have_website = $developmentData["haveWebsite"];
        $development->website_type = $developmentData["websiteType"];
        $development->website_value = $developmentData["websiteValue"];
        $development->website_link = $developmentData["websiteLink"];
        $development->website_dev_date = ($developmentData["websiteDate"] != null)?gmdate("Y", strtotime($developmentData["websiteDate"])):null;
        $development->have_crm = $developmentData["haveCrm"];
        $development->crm_type = $developmentData["crmType"];
        $development->crm_dev = $developmentData["crmDev"];
        $development->crm_dev = $developmentData["crmName"];
        $development->crm_dev = $developmentData["erpName"];
        $development->crm_dev_date = ($developmentData["crmDate"] != null)?gmdate("Y",strtotime($developmentData["crmDate"])):null;
        $development->agency_name = $developmentData["agencyName"];
        $development->save();
        return true;
    }

    public function eventsGet()
    {
        $events = Calendar::get();
        return response()->json([
            "events"=>$events
        ],200);
    }

    public function eventsAdd(Request $request)
    {
        $calendar = Calendar::where("contacts_id",$request->cid)->where("users_id",Auth::id())->first();

        if($calendar){
            $calendar->contacts_id = $request->cid;
            $calendar->title = $request->title;
            $calendar->date = gmdate("Y-m-d H:i:s",strtotime($request->date.' '.$request->time));
            $calendar->description = $request->desc;
            $calendar->color = "blue";
            $calendar->update();
            return response()->json(["error"=>false,"type"=>"edit","message"=>"Événement modifié avec succès","event"=>$calendar]);
        }

        $calendar = new Calendar();
        $calendar->users_id = Auth::id();
        $calendar->contacts_id = $request->cid;
        $calendar->title = $request->title;
        $calendar->date = gmdate("Y-m-d H:i:s",strtotime($request->date.' '.$request->time));
        $calendar->description = $request->desc;
        $calendar->color = "blue";
        $calendar->save();

        return response()->json(["error"=>false,"type"=>"add","message"=>"Événement ajouté avec succès","event"=>$calendar]);
    }

    public function generateZoom(Request $request)
    {
        $eventData = Calendar::where("contacts_id",$request->cid)->where("users_id",Auth::id())->first();
        if(!$eventData) return response()->json(["error"=>true,"message"=>"Vous devez placer l'événement sur l'agenda !"]);
        if($request->type == null || $request->type == "") return response()->json(["error"=>true,"message"=>"Vous devez choisir un type de rendez-vous"]);
        $zoom = $this->getZoomLink($eventData);
        $mailAccess = $this->mailAccesCode($eventData);
        $this->sendConfirmationMail((array)$zoom, $request->cid, $eventData->date, $mailAccess);
        $meet = $this->saveMeeting($zoom,$request->cid,$request->type);
        return response()->json(["error"=>false,"message"=>"Lien zoom généré avec succès","data"=>$zoom,"meet"=>$meet]);

    }

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

    public function sendConfirmationMail($zoom, $cid, $date, $token)
    {
        $email = Contacts::where("id",$cid)->pluck("email")->first();
        $company = Companies::where("contacts_id",$cid)->pluck("name")->first();
        $investment = Investments::where("contacts_id",$cid)->first();
        $grant = TransitionsGrants::where("transitions_id",$investment->service_id)->where("budget","<=",$investment->budget)->orderBy("budget","desc")->first();
        Mail::send( new EligibilityMail($zoom, $cid, $grant->grants, $company, $email, $date, $token) );
    }

    public function saveMeeting($zoom,$cid,$type)
    {
        $meeting = new Meetings();
        $meeting->contacts_id = $cid;
        $meeting->zoom_id = $zoom->id;
        $meeting->topic = $zoom->topic;
        $meeting->type = $type;
        $meeting->date = gmdate("Y-m-d H:i:s",strtotime($zoom->start_time));
        $meeting->link = $zoom->join_url;
        $meeting->password = $zoom->password;
        $meeting->save();
        return $meeting;
    }

    public function confirmContact(Request $request)
    {
        $this->saveEligibility($request->cid,$request->cpnID,$request->regionID);
        $contact = Contacts::where("id",$request->cid)->where("users_id",Auth::id())->first();
        $contact->situation = $request->situation;
        $contact->comment = $request->comment;
        $contact->confirmed = 1;
        $contact->update();
        return response()->json(["error"=>false,"message"=>"contact confirmé avec succès"]);
    }

    public function saveEligibility($cid,$cpnid,$sgid)
    {
        $eligibility = new Eligibility();
        $eligibility->contacts_id = $cid;
        $eligibility->cpn_id = $cpnid;
        $eligibility->regional_id = $sgid;
        $eligibility->save();
    }

    public function saveTimer(Request $request)
    {
        try {
            $counter = new Counter();
            $counter->users_id = Auth::id();
            $counter->elapsed_time = $request->timer;
            $counter->save();
            return response()->json(["error"=>false,"message"=>"Compte à rebours enregistré avec succès"]);
        } catch (QueryException $qe) {
            return response()->json(["error"=>true,"message"=>$qe]);
        }
    }
}

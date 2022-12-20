<?php

namespace App\Http\Controllers\WEB;

use App\Models\Calendar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Verifications;

class MailController extends Controller
{
    public function confirmMeet($token,$cid)
    {
        $verify = Verifications::where("code",$token)->first();
        if($verify->used == 0) {
            Verifications::where("code", $token)->update(["used" => 1]);
            Calendar::where("contacts_id", $cid)->update(['confirmed' => 1,"color"=>"#038418"]);
            return view('web.mails.confirm');
        } else {
            return redirect()->to('https://cpn-aide-aux-entreprises.com');
        }
    } 

    public function changeMeet($token)
    {
        $verify = Verifications::where("code",$token)->first();
        if($verify->used == 0) {
            Verifications::where("code",$token)->update(["used"=>1]);
            return view("web.mails.calendar");
        } else {
            return redirect("home");
        }
    }

    public function getCalendarEvents()
    {
        $events = Calendar::get();
        return response()->json(["events"=>$events]);
    }

    public function updateCalendarEvent(Request $request)
    {
        $event = Calendar::where("contacts_id",$request->id)->first();
        if($event){
            $event->date = gmdate("Y-m-d H:i:s",strtotime($request->date.' '.$request->time));
            $event->update();
            return response()->json(["error"=>false, "message"=>"événement modifier avec succeés"]);
        } else {
            return response()->json(["error"=>true,"message"=>"contact introuvable"]);
        }
        
    }
}

<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CRM\Shared\GlobalController;
use App\Models\Calendar;
use Illuminate\Http\Request;
use App\Http\Resources\CRM\Calendar\CalendarEventsResources;

class CalendarController extends GlobalController
{
    public function getEvents()
    {
        $events = Calendar::get();
        $events = CalendarEventsResources::collection($events);
        return response()->json(["events"=>$events]);
    }

    public function callTester()
    {
        return $this->getAllEvents(3);
    }
    public function deletevent(Request $request ){
        $events = Calendar::where('id',$request->id);
        $events->delete();
        return response()->json(["message"=>"rendez-vous supprimé avec succes"]);

    }
}

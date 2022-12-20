<?php

namespace App\Http\Resources\CRM\Calendar;

use App\Models\Meetings;
use Illuminate\Http\Resources\Json\JsonResource;

class CalendarEventsResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"=>$this->id,
            "uid"=>$this->users_id,
            "cid"=>$this->contacts_id,
            "title"=>$this->title,
            "description"=>$this->description,
            "date"=>gmdate("Y-m-d H:i:s",strtotime($this->date)),
            "color"=>$this->color,
            "confirmed"=>$this->confirmed,
            "meeting"=>Meetings::where("contacts_id",$this->contacts_id)->first(),
        ];
    }
}

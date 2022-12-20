<?php

namespace App\Http\Resources;

use App\Models\Companies;
use App\Models\Eligibility;
use App\Models\Meetings;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientsResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /* return parent::toArray($request); */
        return [
            "id"=>$this->id,
            "conseiller"=>User::select("first_name","last_name")->where("id",Auth::id())->first(),
            "client"=> [
                "first_name"=>$this->first_name,
                "last_name"=>$this->last_name,
            ],
            "societe"=>Companies::where("clients_id",$this->id)->pluck("name")->first(),
            "num_perso"=>$this->phone,
            "num_ent"=>Companies::where("clients_id",$this->id)->pluck("phone")->first(),
            "email"=>$this->email,
            "eligible"=>Eligibility::where("clients_id",$this->id)->pluck("type")->first(),
            "montant"=>Eligibility::where("clients_id",$this->id)->pluck("amount")->first(),
            "meeting"=>Meetings::where("clients_id",$this->id)->pluck("meeting_date")->first(),
        ];
    }
}

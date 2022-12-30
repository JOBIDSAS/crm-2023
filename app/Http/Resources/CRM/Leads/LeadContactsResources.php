<?php

namespace App\Http\Resources\CRM\Leads;

use App\Models\Regions;
use App\Models\Calendar;
use App\Models\Meetings;
use App\Models\Addresses;
use App\Models\Companies;
use App\Models\Turnovers;
use App\Models\Activities;
use App\Models\Eligibility;
use App\Models\Investments;
use App\Models\Transitions;
use App\Models\Developements;
use App\Models\RegionsVouchers;
use App\Models\TransitionsGrants;
use Illuminate\Http\Resources\Json\JsonResource;

class LeadContactsResources extends JsonResource
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
            "id" => $this->id,
            "uid" => $this->users_id,
            "firstname" => $this->first_name,
            "lastname" => $this->last_name,
            "email" => $this->email,
            "phone" => $this->phone,
            "position" => $this->position,
            "comment" => $this->comment,
            "situation" => $this->situation,
            "lead" => $this->lead,
            "confirmed" => $this->confirmed,
            "etat" => $this->etat,
            "created" => $this->created_at,
            "updated" => $this->updated_at,
            "company"=>[
                "cid"=>Companies::where("contacts_id",$this->id)->pluck("id")->first(),
                "activity"=>Activities::where("id",Companies::where("contacts_id",$this->id)->pluck("activities_id")->first())->pluck("name")->first(),
                "name"=>Companies::where("contacts_id",$this->id)->pluck("name")->first(),
                "status"=>Companies::where("contacts_id",$this->id)->pluck("status")->first(),
                "salaries"=>Companies::where("contacts_id",$this->id)->pluck("salaries")->first(),
                "siret"=>Companies::where("contacts_id",$this->id)->pluck("siret")->first(),
                "siren"=>Companies::where("contacts_id",$this->id)->pluck("siren")->first(),
                "naf"=>Companies::where("contacts_id",$this->id)->pluck("naf")->first(),
                "phone"=>Companies::where("contacts_id",$this->id)->pluck("phone")->first(),
                "turnover"=>Companies::where("contacts_id",$this->id)->pluck("turnover")->first(),
                "lturnover"=>[
                    "min"=>Turnovers::where("id",Companies::where("contacts_id",$this->id)->pluck("turnovers_id")->first())->pluck("min")->first(),
                    "max"=>Turnovers::where("id",Companies::where("contacts_id",$this->id)->pluck("turnovers_id")->first())->pluck("max")->first(),
                ],
                "statehelp"=>Companies::where("contacts_id",$this->id)->pluck("state_help")->first(),
                "created"=>Companies::where("contacts_id",$this->id)->pluck("created_at")->first(),
                "updated"=>Companies::where("contacts_id",$this->id)->pluck("updated_at")->first(),
            ],
            "development"=>[
                "did"=>Developements::where("contacts_id",$this->id)->pluck("id")->first(),
                "website"=>Developements::where("contacts_id",$this->id)->pluck("have_website")->first(),
                "websitetype"=>Developements::where("contacts_id",$this->id)->pluck("website_type")->first(),
                "websitevalue"=>Developements::where("contacts_id",$this->id)->pluck("website_value")->first(),
                "websitelink"=>Developements::where("contacts_id",$this->id)->pluck("website_link")->first(),
                "websitedevdate"=>Developements::where("contacts_id",$this->id)->pluck("website_dev_date")->first(),
                "crm"=>Developements::where("contacts_id",$this->id)->pluck("have_crm")->first(),
                "crmtype"=>Developements::where("contacts_id",$this->id)->pluck("crm_type")->first(),
                "crmdev"=>Developements::where("contacts_id",$this->id)->pluck("crm_dev")->first(),
                "crmdevdate"=>Developements::where("contacts_id",$this->id)->pluck("crm_dev_date")->first(),
                "agency"=>Developements::where("contacts_id",$this->id)->pluck("agency_name")->first(),
            ],
            "investment"=>[
                "iid"=>Investments::where("contacts_id",$this->id)->pluck("id")->first(),
                "service"=>Transitions::where( "id", Investments::where("contacts_id",$this->id)->pluck("service_id")->first() )->pluck("name")->first(),
                "transitions"=>Investments::where("contacts_id",$this->id)->pluck("transitions")->first(),
                "budget"=>Investments::where("contacts_id",$this->id)->pluck("budget")->first(),
            ],
            "eligibility"=>[
                "eid"=>Eligibility::where("contacts_id",$this->id)->pluck("id")->first(),
                "cpn"=>TransitionsGrants::where("id",Eligibility::where("contacts_id",$this->id)->pluck("cpn_id")->first())->pluck("grants")->first(),
                "regional"=>$this->regionGrant(
                    Eligibility::where("contacts_id",$this->id)->pluck("regional_id")->first(),
                    Investments::where("contacts_id",$this->id)->pluck("budget")->first()
                )
            ],
            "calendar"=>[
                "aid"=>Calendar::where("contacts_id",$this->id)->pluck("id")->first(),
                "date"=>Calendar::where("contacts_id",$this->id)->pluck("date")->first(),
                "title"=>Calendar::where("contacts_id",$this->id)->pluck("title")->first(),
                "description"=>Calendar::where("contacts_id",$this->id)->pluck("description")->first(),
                "color"=>Calendar::where("contacts_id",$this->id)->pluck("color")->first(),
                "confirmed"=>Calendar::where("contacts_id",$this->id)->pluck("confirmed")->first(),
            ],
            "meeting"=>[
                "mid"=>Meetings::where("contacts_id",$this->id)->pluck("id")->first(),
                "zid"=>Meetings::where("contacts_id",$this->id)->pluck("zoom_id")->first(),
                "topic"=>Meetings::where("contacts_id",$this->id)->pluck("topic")->first(),
                "type"=>Meetings::where("contacts_id",$this->id)->pluck("type")->first(),
                "date"=>Meetings::where("contacts_id",$this->id)->pluck("date")->first(),
                "link"=>Meetings::where("contacts_id",$this->id)->pluck("link")->first(),
                "password"=>Meetings::where("contacts_id",$this->id)->pluck("password")->first(),
            ],
            "address"=>[
                "lid"=>Addresses::where("contacts_id",$this->id)->pluck("id")->first(),
                "address"=>Addresses::where("contacts_id",$this->id)->pluck("address")->first(),
                "region"=>Addresses::where("contacts_id",$this->id)->pluck("region")->first(),
                "city"=>Addresses::where("contacts_id",$this->id)->pluck("city")->first(),
                "zipcode"=>Addresses::where("contacts_id",$this->id)->pluck("zipcode")->first(),
                "department"=>Addresses::where("contacts_id",$this->id)->pluck("department")->first(),
                "country"=>Addresses::where("contacts_id",$this->id)->pluck("country")->first(),
            ]
        ];
    }

    private function regionGrant($region,$budget)
    {
        if($region == null) return [
            "voucher" => null,
            "amount" => null,
            "region" => null,
        ];
        $voucherRes = RegionsVouchers::where("regions_id",$region)->where("min","<=",$budget)->first();
        if(!$voucherRes) return [
            "voucher" => null,
            "amount" => null,
            "region" => null,
        ];
        if($budget>=$voucherRes->max) return [
            "voucher"=>$voucherRes->name,
            "amount"=>$voucherRes->amount,
            "region"=>Regions::where("id",$voucherRes->regions_id)->pluck("name")->first()
        ];
        else return [
            "voucher"=>$voucherRes->name,
            "amount"=>($budget * $voucherRes->refund)/100,
            "region"=>Regions::where("id",$voucherRes->regions_id)->pluck("name")->first()
        ];
    }
}

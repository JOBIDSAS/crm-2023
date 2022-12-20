<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactsLeadsResources extends JsonResource
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
            "firstname"=>$this->first_name,
            "lastname"=>$this->last_name,
            "email"=>$this->email,
            "phone"=>$this->phone,
            "position"=>$this->position,
            "comment"=>$this->comment,
            "situation"=>$this->situation,
            "lead"=>$this->lead,
            "confirmed"=>$this->confirmed,
            "created_at"=>$this->created_at,
            "updated_at"=>$this->updated_at,
        ];
    }
}

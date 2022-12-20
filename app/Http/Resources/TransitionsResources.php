<?php

namespace App\Http\Resources;

use App\Models\Transitions;
use App\Models\TransitionsGrants;
use Illuminate\Http\Resources\Json\JsonResource;

class TransitionsResources extends JsonResource
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
            "name"=>$this->name,
            "category"=>$this->category,
            "orientation"=>TransitionsGrants::where("transitions_id",$this->id)->select("id","orientation")->get(),
            "logo"=>$this->logo,
            "desc"=>$this->desc,
            "budget"=>TransitionsGrants::where("transitions_id",$this->id)->pluck("budget")->first(),
        ];
    }
}

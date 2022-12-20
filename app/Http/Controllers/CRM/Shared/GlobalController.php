<?php

namespace App\Http\Controllers\CRM\Shared;

use App\Models\Calendar;
use App\Models\Companies;
use App\Models\Contacts;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class GlobalController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // global calendar controller //

    protected function getAllEvents()
    {
        return Calendar::all();
    }

    // global leads controller //

    public function getAllContacts()
    {
        return Contacts::all();
    }

    // global leads controller //

    public function getAllCompanies()
    {
        return Companies::all();
    }

}

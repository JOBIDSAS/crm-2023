<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function UsersDetails()
    {
        $users = User::get();
        return response()->json(["users"=>$users]);
    }
}

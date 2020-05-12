<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class dataController extends Controller
{
    //
    public function legislator()
    {
        $user=Auth::user();
        if ($user->controll_level==1)
        {
            return view("dataupdate");
        } else {
            return redirect("/");
        }
    }
}

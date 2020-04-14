<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function crate_detail() {
        
    }
    
    public function show_detail() {
        
        return view('user.profile');
    }

}

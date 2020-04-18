<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UserController extends Controller
{
    //
    
    use AuthenticatesUsers;
    
    public function crate_detail() {
        
    }
    
    public function show_detail()
    {
        return view('user.profile');
    }
    
    public function getLogout()
    {
        Auth::Logout();
        return redirect()->route('top');
    }
    
}

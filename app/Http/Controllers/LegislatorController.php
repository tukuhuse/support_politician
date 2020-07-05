<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegislatorController extends Controller
{
    //
    public function legislatorstore(Request $request) {
        
        $file = $request->file('file');
        Excel::import(new Legislator,$file);
    }
    
    public function speakergroupstore(Request $request) {
        
        $file = $request->file('file');
        Excel::import(new Speaker_group,$file);
    }
    
    public function constituencystore(Request $request) {
        
        $file = $request->file('file');
        Excel::import(new Constituency,$file);
    }
}

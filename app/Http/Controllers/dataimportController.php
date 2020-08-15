<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Legislator;
use App\Constituency;
use App\Speaker_group;
use App\Paraliament;

use App\Imports\LegislatorImport;
use App\Imports\Speaker_groupImport;
use App\Imports\ConstituencyImport;

class dataimportController extends Controller
{
    //
    public function store(Request $request) {
        
        $file = $request -> file('file');
        
        $paraliament = Paraliament::firstOrCreate(['name' => '衆議院']);
        $paraliament = Paraliament::firstOrCreate(['name' => '参議院']);
        
        switch ($request->kind) {
            case 1;
                legislator::truncate();
                Excel::import(new LegislatorImport,$file);
                break;
            case 2;
                speaker_group::truncate();
                Excel::import(new Speaker_groupImport,$file);
                break;
            case 3;
                constituency::truncate();
                Excel::import(new ConstituencyImport,$file);
        }
        
        return redirect('/datasetting')->with('message', 'データ更新に成功しました');
        
    }
}

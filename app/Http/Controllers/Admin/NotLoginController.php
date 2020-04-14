<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Weidner\Goutte\GoutteFacade as GoutteFacade;

class NotLoginController extends Controller
{
    //topページを表示
    public function top() {
        return view('top');
    }
    
    public function datashow() {
        $url='http://seiji.kpi-net.com/api/?type=1&count=480&format=json';
        $json=GoutteFacade::request('GET', $url);
        $array=json_decode($json,true);
        Log::var_dump($array);
        //return view('auth.legislatorupdate',['members'=>$members]);
    }
}

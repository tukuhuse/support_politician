<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Weidner\Goutte\GoutteFacade as GoutteFacade;

class DataAdminController extends Controller
{
    //
    public function index() {
        $url='http://seiji.kpi-net.com/api/?type=1&count=480&format=json';
        $dataapi=GoutteFacade::request('GET', $url);
        $json=file_get_contents($dataapi);
        $arr=json_decode($json,true);
        Log::debug(print_r($arr,true));
        Log::debug('$arr->result='.$arr->result);
        /*
        $legislator=new legislator;
        $legislator->name=$arr[1]['name'];
        $legislator->save();*/
    }
}

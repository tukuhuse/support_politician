<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte;

class kokkaiapi extends Controller
{
    //
    
    const BASE_URL = 'https://kokkai.ndl.go.jp/api/';
    const FIND_WAY = [
        'meeting' => 'meeting?',
        'speech' => 'speech?',
    ];
    
    public function search_topic()
    {
        return view('topic');
    }
    
    public function find_comment(Request $request)
    {
        $url = self::BASE_URL;
        $url .= self::FIND_WAY['speech'];
        $url .= 'any=' . urlencode($request->search_word);
        $url .= '&searchRange='. urlencode('本文');
        //$url .= "&recordPacking=json";
        
        //dd($url);
        
        $data = $this->https_api($url);
        
        dd($data);
        
        return view('searchresult', ['result' => $data]);
        
        /*
        $data = $this->https_api($url);
        return redirect('/searchresult',['data'=>$data]);
        */
    }
    
    private function https_api($url)
    {
        $client = new Goutte\Client();
        $xml = $client->request('GET',$url)->xml();
        dd($xml);
        //$obj = simplexml_load_string($XML);
        //$data = json_decode(json_encode($obj),true);
        
        //$data = json_decode($json,true);
        
        //dd($json);
        
        return $data;
    }
    
}

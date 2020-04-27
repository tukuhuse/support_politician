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
        $url .= "&recordPacking=json";
        
        $data = $this->https_api($url);
        
        foreach ($data["speechRecord"] as &$speech)
        {
            $speech["speech"]=str_replace("　","",substr($speech["speech"],stripos($speech["speech"],"　")));
        }
        
        return view('searchresult', ['result' => $data]);
    }
    
    private function https_api($url)
    {
        $client = new Goutte\Client();
        $json = $client->request('GET',$url);
        $data = json_decode($client->getInternalResponse()->getContent(),true);
        
        return $data;
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte;

class kokkaiapi extends Controller
{
    //
    
    const BASE_URL = 'https://kokkai.ndl.go.jp/api/';
    const FIND_WAY = [
        'list' => 'meeting_list?',
        'meeting' => 'meeting?',
        'speech' => 'speech?',
    ];
    
    public function search_topic()
    {
        return view('topic');
    }
    
    public function find_comment(Request $request)
    {
        //検索するurlを生成
        $url = $this->urlgenerater($request->invisible,1,$request->search_word);
        //国会議事録で検索
        $data = $this->https_api($url);
        
        //データから余計な空白を除去(発言内容のみ)
        foreach ($data["speechRecord"] as &$speech)
        {
            $speech["speech"]=str_replace("　","",substr($speech["speech"],stripos($speech["speech"],"　")));
        }
        
        //viewに検索結果を渡す
        return view('searchresult', ['result' => $data]);
    }
    
    public function detail_topic(Request $request)
    {
        $url = $this -> urlgenerater(2,1,null,$request->issueID);
        
        $data = $this -> https_api($url);
        
        $data=$data["meetingRecord"][0]["speechRecord"];
        
        //データから余計な空白を除去(発言内容のみ)
        foreach ($data as &$speech)
        {
            $speech["speech"]=str_replace("　","",substr($speech["speech"],stripos($speech["speech"],"　")));
        }
        
        return view('detailmeeting', ['result' => $data]);
    }
    
    //以下共通処理の関数
    //http通信をする関数
    private function https_api($url)
    {
        $client = new Goutte\Client();
        $json = $client->request('GET',$url);
        $data = json_decode($client->getInternalResponse()->getContent(),true);
        
        return $data;
    }
    
    //検索用のurlを作成する関数
    private function urlgenerater($findway,$startrecord=1,$search_word=null,$issue=null)
    {
        $url = self::BASE_URL;
        //1なら会議検索、2なら発言検索
        switch ($findway) {
            case 1:
                $url .= self::FIND_WAY['speech'];
                $url .= 'maximumRecords=100';
                break;
            case 2:
                $url .= self::FIND_WAY['meeting'];
                $url .= 'maximumRecords=1';
                break;
            case 3:
                $url .= self::FIND_WAY['list'];
                $url .= 'maximumRecords=30';
                break;
        }
        
        $url .= $this->queryword('&any=',urlencode($search_word));
        $url .= '&searchRange=' . urlencode('本文');
        $url .= $this->queryword('&issueID=',$issue);

        $url .= "&recordPacking=json";
        
        return $url;
    }
    
    //検索文字に空白文字がある場合の処理
    private function queryword($keyword,$settingword=null)
    {
        $queryword=null;
        if (!empty($settingword)) {
            $queryword = $keyword . $settingword;
        }
        return $queryword;
    }
    
}

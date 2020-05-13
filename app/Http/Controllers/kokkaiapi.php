<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte;
use Auth;
use App\Comment;
use App\Legislator;
use App\Speaker_group;
use App\Constituency;

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
        //$findway,$startrecord=1,$search_word=null,$issue=null,$legislators=null
        $url = $this->urlgenerater($request->invisible,1,$request->search_word,null,null);
        $data = $this->https_api($url);
        $data["speechRecord"] = $this->speechformat($data["speechRecord"]);
        
        //viewに検索結果を渡す
        return view('searchresult', ['result' => $data]);
    }
    
    public function detail_topic($issueID)
    {
        /*
        $url = $this -> urlgenerater(2,1,null,$request->issueID);
        $data = $this -> https_api($url);
        
        $data=$data["meetingRecord"][0]["speechRecord"];
        unset($data[0]);
        $data=array_values($data);
        
        $data = $this -> speechformat($data);
        $issue = Comment::where('issueID',$request->issueID)->get();
        
        return view('detailmeeting', ['result' => $data,'issueID' => $request->issueID, 'comments' => $issue]);
        */
        $url = $this -> urlgenerater(2,1,null,$issueID);
        $data = $this -> https_api($url);
        
        $data=$data["meetingRecord"][0]["speechRecord"];
        unset($data[0]);
        $data=array_values($data);
        
        $data = $this -> speechformat($data);
        $comments = Comment::where('issueID',$issueID)->get();
        
        return view('detailmeeting', ['result' => $data,'issueID' => $issueID, 'comments' => $comments]);
        
    }
    
    public function search_legislator_topic(Request $request)
    {
        $legislators=Legislator::all()->pluck('name','id');
        $constituencies=Constituency::all()->pluck('name','id');
        $speakergroups=Speaker_group::all()->pluck('name','id');
        return view('legislatortopic',['legislators' => $legislators,'constituencies' => $constituencies,'speaker_groups' => $speakergroups]);
    }
    
    public function result_legislator_index(Request $request)
    {
        $legislator = Legislator::where('id',$request->legislator_id)->first();
        $legislators = array($legislator->name);
        $url = $this->urlgenerater($request->invisible,1,null,null,$legislators);
        $data = $this->https_api($url);
        
        $data["speechRecord"] = $this->speechformat($data["speechRecord"]);
        return view('searchresult',['result' => $data]);
    }
    
    public function result_constituency_index(Request $request)
    {
        $constituency = Constituency::where('id',$request->constituency_id)->first();
        $legislators = Legislator::where('constituency_id',$constituency->id)->pluck('name');
        
        $url = $this->urlgenerater($request->invisible,1,null,null,$legislators);
        $data = $this->https_api($url);
        
        $data["speechRecord"] = $this->speechformat($data["speechRecord"]);
        return view('searchresult',['result' => $data]);
    }
    
    public function result_speakergroup_index(Request $request)
    {
        //$normalspeakergroup = array("自由民主党",);
        
        $speakergroup = Speaker_group::where('id',$request->speaker_group_id)->first();
        $legislators = Legislator::where('speaker_group_id',$speakergroup->id)->pluck('name');
        
        $url = $this->urlgenerater($request->invisible,1,null,null,null,$speakergroup->name);
        $data = $this->https_api($url);
        
        dd($data);
        
        $data["speechRecord"] = $this->speechformat($data["speechRecord"]);
        return view('searchresult',['result' => $data]);
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
    private function urlgenerater($findway,$startrecord=1,$search_word=null,$issue=null,$legislators=null,$speakergroup=null)
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
        
        $legislatorquery = "";
        if ($legislators!=null) {
            foreach ($legislators as $legislator) {
                $legislator = str_replace(" ","",$legislator);
                $legislatorquery .= " " . urlencode($legislator);
            }
            $legislatorquery = trim($legislatorquery);
        }
        
        $url .= $this->queryword('&any=',urlencode($search_word));
        $url .= $this->queryword('&speaker=',$legislatorquery);
        $url .= '&searchRange=' . urlencode('本文');
        $url .= $this->queryword('&issueID=',$issue);
        $url .= $this->queryword('&speakerGroup=',urlencode($speakergroup));

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
    
    //
    private function speechformat($data)
    {
        $records = $data;
        
        foreach ($records as &$speech)
        {
            $speech["speech"]=str_replace("　","",substr($speech["speech"],stripos($speech["speech"],"　")));
            $speech["speech"]=str_replace("―――――――――――――","",$speech["speech"]);
        }
        
        return $records;
        
    }
}

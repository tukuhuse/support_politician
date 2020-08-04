<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte;
use Auth;
use App\Comment;
use App\Good;
use App\Legislator;
use App\Speaker_group;
use App\Constituency;

class parliamentController extends Controller
{
    //検索フォーム表示
    public function search_screen()
    {
        $legislators=Legislator::all()->pluck('name','id');
        $constituencies=Constituency::all()->pluck('name','id');
        $speakergroups=Speaker_group::all()->pluck('name','id');
        return view('top',['legislators' => $legislators,'constituencies' => $constituencies,'speaker_groups' => $speakergroups]);
    }
    
    //検索する処理
    public function index(Request $request)
    {
        //選挙区検索又は議員検索
        if (!empty($request->constituency_id)) $legislators = Legislator::where('constituency_id',$request->constituency_id)->pluck('name');
        else {
            if (!empty($request->legislator_id)) {
                $legislator = Legislator::where('id',$request->legislator_id)->first();
                $legislators = array($legislator->name);
            } else $legislators = null;
        }
        
        //政党検索
        if (!empty($request->speaker_group_id)) $speakergroup = Speaker_group::where('id',$request->speaker_group_id)->first()->name;
        else $speakergroup = null;
        
        $url = $this->urlgenerater(1,1,$request->search_word,null,$legislators,$speakergroup);
        $flag = is_null($request->search_word) && is_null($request->constituency_id) && is_null($request->legislator_id) && is_null($request->speaker_group_id);
        $data = $this->https_api($url);
        if (!$flag && $data["numberOfRecords"] > 0) $data["speechRecord"] = $this->speechformat($data["speechRecord"]);
        
        return view('parliament.index',['result' => $data,'searchflag' => $flag]);
    }
    
    //討論の詳細を表示
    public function show($issueID)
    {
        $url = $this -> urlgenerater(2,1,null,$issueID);
        $data = $this -> https_api($url);
        
        //不要なデータを削除
        $data=$data["meetingRecord"][0]["speechRecord"];
        unset($data[0]);
        $data=array_values($data);
        $data = $this -> speechformat($data);
        
        //コメントを取得
        $comments = Comment::where('issueID',$issueID)->get();
        if ( Auth::check() ) {
            $good = Good::where('user_id',Auth::id())
                ->where('speechID','like',"%$issueID%")
                ->pluck('status','speechID');
        } else $good = null;
        
        return view('parliament.show', ['result' => $data,'issueID' => $issueID, 'comments' => $comments, 'good' => $good]);
    }
    
    //以下共通処理
    //使用する定数
    const BASE_URL = 'https://kokkai.ndl.go.jp/api/';
    const FIND_WAY = [
        'meeting' => 'meeting?',
        'speech' => 'speech?',
    ];
    
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
    private function urlgenerater($findway=1,$startrecord=1,$search_word=null,$issue=null,$legislators=null,$speakergroup=null)
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
        if (!empty($settingword)) $queryword = $keyword . $settingword;
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
            $speech["speech"]=str_replace("─────────────","",$speech["speech"]);
        }
        
        return $records;
    }
}
